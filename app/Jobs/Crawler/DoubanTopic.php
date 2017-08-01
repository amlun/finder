<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 上午11:24
 */

namespace App\Jobs\Crawler;

use App\Jobs\Crawler;
use App\Jobs\Crawler\Image as ImageJob;
use App\Girl;
use App\Image;
use App\Topic;
use Log;

/**
 * Class DoubanTopic
 * 抓取豆瓣小组文章任务
 * 另外，此任务会生成抓取文章作者的相册任务 `DoubanAlbumList`
 *
 * @package App\Jobs\Crawler
 */
class DoubanTopic extends Crawler
{
    protected $_once = true;

    protected function on_handle()
    {
        Log::debug('crawl douban topic start', ['link' => $this->_link]);

        // 处理内容
        $crawler = $this->_client->request('GET', $this->_link);
        $girl_name = trim($crawler->filterXPath('//h3/span/a')->text());
        $girl_head = $crawler->filterXPath('//*[@id="content"]/div/div[1]/div[1]/div[1]/a/img')->attr('src');
        $girl_link = $crawler->filterXPath('//h3/span/a')->attr('href');
        $topic_title = trim($crawler->filterXPath('//div[@id="content"]/h1')->text());
        $topic_content = trim($crawler->filterXPath('//div[@class="topic-content"]')->text());
        $image_links = $crawler->filterXPath('//div[@class="topic-figure cc"]/img')->extract('src');

        $girl = Girl::firstOrCreate(['link_md5' => md5($girl_link)], ['name' => $girl_name, 'link' => $girl_link, 'head' => $girl_head]);

        // 保存
        if (!empty($image_links)) {
            // 保存文章信息
            $topic = Topic::firstOrNew(['link_md5' => md5($this->_link)], ['title' => $topic_title, 'content' => $topic_content, 'link' => $this->_link]);
            $topic = $girl->topics()->save($topic);
            $images = [];
            foreach ($image_links as $image_link) {
                Log::info('crawl douban topic add image', ['link' => $image_link]);
                $local_path = self::localImagePath($image_link);
                dispatch(new ImageJob($image_link, $local_path));
                Log::info('dispatch image job', ['link' => $image_link]);
                $images[] = Image::firstOrNew(['link_md5' => md5($image_link)], ['link' => $image_link, 'path' => $local_path]);
            }
            $topic->images()->saveMany($images);
        }

        // 另外抓取这个girl的相册
//        dispatch(new DoubanAlbumList($girl_link . 'photos'));
//        Log::info('dispatch douban album list job', ['link' => $girl_link . 'photos']);

        Log::debug('crawl douban topic success', ['link' => $this->_link]);
    }

}