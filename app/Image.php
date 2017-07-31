<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/26
 * Time: 下午6:38
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Image
 *
 * @property-read \App\Topic $topic
 * @mixin \Eloquent
 */
class Image extends Model
{
    protected $fillable = ['link', 'link_md5', 'path'];

    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }
}