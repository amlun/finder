<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 下午3:10
 */

namespace App\Jobs\Crawler;


use App\Jobs\Job as BaseJob;
use Cache;

abstract class Job extends BaseJob
{
    /**
     * @param $url
     * @return bool
     */
    protected function lockUrl($url)
    {
        return Cache::add($this->lockKey($url), true, 5);
    }

    /**
     * @param $url
     * @return bool
     */
    protected function unLockUrl($url)
    {
        return Cache::forget($this->lockKey($url));
    }

    /**
     * @param $url
     */
    protected function stashUrl($url)
    {
        Cache::put($this->lockKey($url), time(), 30 * 24 * 60);
    }

    /**
     * @param $url
     * @return string
     */
    protected function lockKey($url)
    {
        return 'url:' . md5($url);
    }

    /**
     * @param $image_url
     * @return string
     */
    public static function localImagePath($image_url)
    {
        $ext = pathinfo($image_url, PATHINFO_EXTENSION);
        $hash = sha1($image_url);
        return 'images/' . date('Y-m-d') . '/' . $hash . '.' . $ext;
    }
}