<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/28
 * Time: 下午2:44
 */

namespace App\Jobs\Crawler;

use App\Jobs\Crawler;
use Storage;

class Image extends Crawler
{
    protected $_once = true;
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
            Storage::disk('public')->put($this->_path, file_get_contents($this->_link));
        } catch (\Exception $e) {
        }
    }

}