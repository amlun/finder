<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/28
 * Time: 下午2:44
 */

namespace App\Jobs\Crawler;

use App\Jobs\Crawler;
use Log;
use Storage;

class Image extends Crawler
{
    /**
     * local image path
     *
     * @var string
     */
    protected $_path;

    public function __construct($link, $path)
    {
        parent::__construct($link);
        $this->_path = $path;
    }

    protected function on_handle()
    {
        try {
            Storage::disk('public')->put($this->_path, file_get_contents($this->_link . '?time=' . time()));
            $this->stashLink($this->_link);
            Log::info('download image sucess', ['link' => $this->_link, 'path' => $this->_path]);
        } catch (\Exception $e) {
            Log::error('download image fail', ['link' => $this->_link, 'path' => $this->_path]);
        }
    }
}