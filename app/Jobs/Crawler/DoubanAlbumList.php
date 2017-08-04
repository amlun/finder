<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 上午11:12
 */

namespace App\Jobs\Crawler;

use App\Album;
use App\Girl;
use App\Jobs\Crawler;
use Log;

/**
 * Class DoubanAlbumList
 *
 * 图集种子页
 * 抓取豆瓣图集，此任务会生成多个 `DoubanAlbum`
 *
 * @package App\Jobs\Crawler
 */
class DoubanAlbumList extends Crawler
{
    protected function on_handle()
    {
        Log::debug('crawl douban album list start', ['link' => $this->_link]);

        $crawler = $this->_client->request('GET', $this->_link);

        // 处理Girl内容
        $girl_link = $crawler->filterXPath('//div[@id="db-usr-profile"]/div[1]/a')->attr('href');
        $girl_name = $crawler->filterXPath('//div[@id="db-usr-profile"]/div[1]/a/img')->attr('alt');
        $girl_head = $crawler->filterXPath('//div[@id="db-usr-profile"]/div[1]/a/img')->attr('src');
        $girl = Girl::firstOrCreate(['link_md5' => md5($girl_link)], ['name' => $girl_name, 'link' => $girl_link, 'head' => $girl_head]);

        //处理图集
        $crawler->filterXPath('//div[@class="albumlst"]')->each(function ($sub_crawler) use ($girl) {
            $cover = $sub_crawler->filterXPath('//img[@class="album"]')->attr('src');
            $title = trim($sub_crawler->filterXPath('//div[@class="pl2"]')->text());
            $link = $sub_crawler->filterXPath('//a[@class="album_photo"]')->attr('href');
            // 生成相册对象
            $album = Album::firstOrCreate(
                ['link_md5' => md5($link)],
                ['cover' => $cover, 'title' => $title, 'link' => $link, 'girl_id' => $girl->id]
            );
            dispatch(new DoubanAlbum($link));
            Log::info('dispatch douban album job', ['link' => $link]);
        });
        Log::debug('crawl douban album list success', ['link' => $this->_link]);

        // next page
        try {
            $next_page = $crawler->filterXPath('//span[@class="next"]/a')->attr('href');
            if (!empty($next_page)) {
                dispatch(new DoubanAlbumList($next_page));
                Log::info('dispatch douban album list next page', ['link' => $next_page]);
            }
        } catch (\Exception $e) {
            Log::notice('crawl douban album list end', ['link' => $this->_link]);
        }
    }
}