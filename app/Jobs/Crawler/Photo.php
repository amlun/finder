<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 下午3:10
 */

namespace App\Jobs\Crawler;

use Log;

class Photo extends Job
{
    protected $url;
    protected $path;

    public function __construct($url, $path)
    {
        $this->url = $url;
        $this->path = $path;
    }

    public function handle()
    {
        if ($this->lockUrl($this->url)) {
            try {
                $photo_body = file_get_contents($this->url . '?time=' . time());
                \Storage::disk('public')->put($this->path, $photo_body);
                $this->stashUrl($this->url);
                Log::info('download image success', ['url' => $this->url, 'path' => $this->path]);
            } catch (\Exception $e) {
                Log::error('download image fail: ' . $e->getMessage(), ['url' => $this->url, 'path' => $this->path]);
            }
        }

    }
}