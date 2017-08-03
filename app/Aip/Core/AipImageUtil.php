<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/3
 * Time: 上午11:17
 */
namespace App\Aip\Core;

class AipImageUtil
{

    /**
     * 获取图片信息
     * @param  $content string
     * @return array
     */
    public static function getImageInfo($content)
    {
        $info = getimagesizefromstring($content);
        return array(
            'mime' => $info['mime'],
            'width' => $info[0],
            'height' => $info[1],
        );
    }
}

// var_dump(AipUtil::getImageInfo(file_get_contents('../test/general.png')));
