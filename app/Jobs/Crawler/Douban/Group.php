<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 上午11:16
 */

namespace App\Jobs\Crawler\Douban;


class Group extends Base
{
    const URI_REGEX = '/api/v2/group/%s/topics';

    function on_handle($body)
    {
        $topics = $body['topics'];
        foreach ($topics AS $topic) {
            if ($this->lockUrl($topic['url'])) {
                dispatch(new Topic($topic['id']));
            }
        }
    }
}