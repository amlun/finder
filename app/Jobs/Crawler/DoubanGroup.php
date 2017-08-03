<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 上午10:22
 */

namespace App\Jobs\Crawler;

use App\Jobs\Crawler;
use Log;

/**
 * Class DoubanGroup
 *
 * 文章种子页
 * 抓取豆瓣小组列表，此任务会生成多个 `DoubanTopic`
 *
 * @package App\Jobs\Crawler
 */
class DoubanGroup extends Crawler
{
    protected function on_handle()
    {
        Log::debug('crawl douban group start', ['link' => $this->_link]);

        $crawler = $this->_client->request('GET', $this->_link);
        $links = $crawler->filterXPath('//td[@class="title"]/a')->extract('href');
        // TODO 如何寻找想要的帖子?
        foreach ($links as $link) {
            if ($this->lockLink($link)) {
                dispatch(new DoubanTopic($link));
                Log::info('dispatch douban topic job', ['link' => $this->_link, 'topic_link' => $link]);
            }
        }

        Log::debug('crawl douban group success', ['link' => $this->_link]);
    }
}