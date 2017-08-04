<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/28
 * Time: 下午2:44
 */

namespace App\Jobs\Crawler;

use App\Image as ImageModel;
use App\Jobs\Crawler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            $image = ImageModel::where('link_md5', md5($this->_link))->firstOrFail();
            $image_body = file_get_contents($this->_link . '?time=' . time());
            // 增加百度人脸检测
            $options = [
                'max_face_num' => 1,
                'face_fields' => 'gender'
            ];
            $result = app('AipFace')->detect($image_body, $options);
            // 检测到人脸且是男性
            if ($result['result_num'] > 0 && $result['result'][0]['gender'] == 'male') {
                // 删除图片
                $image->delete();
            } else {// 检测到人脸且是女性或没有人脸
                Storage::disk('public')->put($this->_path, $image_body);
            }
            $this->stashLink($this->_link);
            Log::info('download image success', ['link' => $this->_link, 'path' => $this->_path]);
        } catch (ModelNotFoundException $e) {
            Log::error('image object not found', ['link' => $this->_link, 'path' => $this->_path]);
        } catch (\Exception $e) {
            Log::error('download image fail: ' . $e->getMessage(), ['link' => $this->_link, 'path' => $this->_path]);
        }
    }
}