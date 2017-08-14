<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/9
 * Time: 下午1:05
 */

namespace App\Jobs\Crawler\Douban;

use App\Girl as GirlModel;
use App\Jobs\Crawler\Photo;
use App\Photo as PhotoModel;
use App\Topic as TopicModel;

class Topic extends Base
{
    const URI_REGEX = '/api/v2/group/topic/%s';

    function on_handle($topic)
    {
        // 处理Girl信息
        $author = $topic['author'];

        // F is female, U is unknown
        if ($author['gender'] !== 'F' && $author['gender'] !== 'U') {
            $this->fallException($topic['url'], 'Not a girl！');
        }

        // ['name', 'avatar', 'url', 'url_md5']
        $girl_url_md5 = md5($author['url']);
        $girl_obj = GirlModel::where('url_md5', $girl_url_md5)->first();

        // create girl
        if (empty($girl_obj)) {
            $girl_avatar_path = '';
            // girl的头像
            if (!empty($author['avatar'])) {
                $girl_avatar_url = $author['avatar'];
                $girl_avatar_path = self::localImagePath($girl_avatar_url);
                dispatch(new Photo($girl_avatar_url, $girl_avatar_path));
            }
            // 保存girl的基本信息
            $girl_obj = GirlModel::firstOrCreate(
                ['url_md5' => $girl_url_md5],
                ['name' => $author['name'], 'avatar' => $girl_avatar_path, 'url' => $author['url'], 'ban' => 0]
            );
        }
        if ($girl_obj->ban != 0) {
            $this->fallException($topic['url'], 'Banned girl!');
        }

        $girl_id = $girl_obj->id;

        // topic
        $topic_url = $topic['url'];
        $title = $topic['title'];
        $content = $topic['content'];

        // topic的头图
        if (empty($topic['cover_url'])) {
            $this->fallException($topic['url'], 'Not contains image');
        }
        $topic_cover_url = substr($topic['cover_url'], 0, strpos($topic['cover_url'], '?'));
        $topic_cover_path = self::localImagePath($topic_cover_url);
        dispatch(new Photo($topic_cover_url, $topic_cover_path));

        // 保存topic
        $topic_obj = TopicModel::firstOrCreate(
            ['url_md5' => md5($topic_url)],
            ['girl_id' => $girl_id, 'title' => $title, 'cover' => $topic_cover_path, 'content' => $content, 'url' => $topic_url]
        );

        // 保存topic的图片
        if (!empty($topic['photos'])) {
            $photo_obj_arr = [];
            foreach ($topic['photos'] as $photo) {
                $photo_url = substr($photo['alt'], 0, strpos($photo['alt'], '?'));
                $photo_path = self::localImagePath($photo_url);
                dispatch(new Photo($photo_url, $photo_path));
                $photo_obj_arr[] = PhotoModel::firstOrNew(
                    ['url_md5' => md5($photo_url)],
                    ['url' => $photo_url, 'path' => $photo_path, 'title' => $photo['title'], 'seq' => $photo['seq_id']]
                );
            }
            $topic_obj->photos()->saveMany($photo_obj_arr);
        }

        $this->fallException($topic['url']);
    }

    private function fallException($url, $message = null)
    {
        $this->stashUrl($url);
        if (isset($message)) {
            throw new \Exception($message);
        }
    }
}