<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/26
 * Time: 下午6:44
 */

namespace App\Jobs;

use Cache;
use Goutte\Client;
//use GuzzleHttp\Client as GuzzleClient;
use InvalidArgumentException;
use Log;

/**
 * Class Crawler
 * 基础爬虫任务
 *
 * @package App\Jobs
 */
abstract class Crawler extends Job
{
    protected $_client;
    protected $_link;

    public function __construct($link)
    {
        $this->_link = $link;
        // 个性化Client UA Proxy cookies 等
        $this->_client = new Client([
            'HTTP_USER_AGENT' => random_ua(),
        ]);
        return $this;
    }

    public function handle()
    {
        try {
            $this->on_handle();
        } catch (AlreadyCrawlException $e) {
            // pass to do nothing
        } catch (\Exception $e) {
            Log::error($e);
        }
        return true;
    }

    protected function lockLink($link)
    {
        return Cache::add($this->lockKey($link), true, 5);
    }

    protected function unLockLink($link)
    {
        return Cache::forget($this->lockKey($link));
    }

    protected function stashLink($link)
    {
        Cache::forever($this->lockKey($link), time());
    }

    protected function lockKey($link)
    {
        return 'link:' . md5($link);
    }

    abstract protected function on_handle();

    /**
     * @param $image_link
     * @return string
     */
    public static function localImagePath($image_link)
    {
        $ext = pathinfo($image_link, PATHINFO_EXTENSION);
        $parts = array_slice(str_split($hash = sha1($image_link), 2), 0, 2);
        return 'img/' . implode('/', $parts) . '/' . $hash . '.' . $ext;
    }
}


function random_ua()
{
    $_UA = [
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
        'JUC (Linux; U; 2.3.6; zh-cn; GT-I8150; 480*800) UCWEB8.7.4.225/145/800',
        'Mozilla/5.0 (Series40; Nokia501/10.0.2; Profile/MIDP-2.1 Configuration/CLDC-1.1) Gecko/20100401 S40OviBrowser/3.0.0.0.73',
        'Opera/9.80 (X11; Linux zvav; U; zh) Presto/2.8.119 Version/11.10',
        'Opera Mini on a Nokia 5230 running Series60 5.0',
        'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36 OPR/38.0.2220.41'
    ];

    return $_UA[rand(0, 7)];
}