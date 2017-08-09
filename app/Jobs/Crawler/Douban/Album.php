<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 下午4:16
 */

namespace App\Jobs\Crawler\Douban;


class Album extends Base
{
    const URI_REGEX = '/api/v2/photo_album/%s/photos';

    function on_handle($body)
    {
        $photos = $body['photos'];
        foreach ($photos as $photo) {
            
        }
    }

}