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
    protected $_once = false;

    public function __construct($link)
    {
        $this->_link = $link;
        // 个性化Client UA Proxy cookies 等
        $this->_client = new Client([
            'HTTP_USER_AGENT' => random_ua(),
        ]);
    }

    public function handle()
    {
        try {
            $this->begin();
            $this->on_handle();
            $this->commit();
        } catch (AlreadyCrawlException $e) {
            Log::notice('already crawl the page', ['link' => $this->_link]);
            // pass to do nothing
        } catch (InvalidArgumentException $e) {
            Log::notice('invalid argument', ['link' => $this->_link]);
            $this->commit();
        }
        return true;
    }

    protected function begin()
    {
        if ($this->_once && !Cache::add($this->_key(), true, 1)) {
            throw new AlreadyCrawlException();
        }
    }

    protected function commit()
    {
        $this->_once && Cache::forever($this->_key(), time());
    }

    protected function rollback()
    {
        $this->_once && Cache::forget($this->_key());
    }

    protected function _key()
    {
        return 'link:' . md5($this->_link);
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