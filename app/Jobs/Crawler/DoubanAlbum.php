<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 上午11:12
 */

namespace App\Jobs\Crawler;

use App\Album;
use App\Jobs\Crawler;
use App\Jobs\Crawler\Image as ImageJob;
use App\Photo;
use Log;

/**
 * Class DoubanAlbum
 * 抓取豆瓣图集，此任务只抓取列表，此任务会生成多个 `DoubanPhoto`
 *
 * @package App\Jobs\Crawler
 */
class DoubanAlbum extends Crawler
{
    protected function on_handle()
    {
        Log::debug('crawl douban album start', ['link' => $this->_link]);

        // album
        $flag = strpos($this->_link, '?');
        $album_link = $this->_link;
        if ($flag > 0) {
            $album_link = substr($this->_link, 0, $flag);
        }
        $album = Album::firstOrCreate(['link_md5' => md5($album_link)], ['link' => $album_link]);
        $crawler = $this->_client->request('GET', $this->_link);
        $photo_links = $crawler->filterXPath('//div[@class="photo_wrap"]/a/img')->extract('src');
        $photos = [];
        foreach ($photo_links AS $photo_link) {
            $photo_link = str_replace(['lthumb', 'webp'], ['large', 'jpg'], $photo_link);
            $local_path = self::localImagePath($photo_link);
            dispatch(new ImageJob($photo_link, $local_path));
            Log::info('dispatch image job', ['link' => $photo_link]);
            $photos[] = Photo::firstOrNew(['link_md5' => md5($photo_link)], ['link' => $photo_link, 'path' => $local_path]);
            Log::info('crawl douban album add photo', ['link' => $photo_link]);
        }
        $album->photos()->saveMany($photos);
        Log::debug('crawl douban album success', ['link' => $this->_link]);

        // next page
        try {
            $next_page = $crawler->filterXPath('//span[@class="next"]/a')->attr('href');
            if (!empty($next_page)) {
                dispatch(new DoubanAlbum($next_page));
                Log::info('dispatch douban album next page', ['link' => $next_page]);
            }
        } catch (\Exception $e) {
            Log::info('crawl douban album end', ['link' => $this->_link]);
        }
    }
}