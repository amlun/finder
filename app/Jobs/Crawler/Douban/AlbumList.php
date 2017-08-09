<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 下午4:16
 */

namespace App\Jobs\Crawler\Douban;


class AlbumList extends Base
{
    const URI_REGEX = '/api/v2/user/%s/photo_albums';

    function on_handle($body)
    {

    }

}