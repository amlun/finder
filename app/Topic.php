<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 上午10:40
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Topic
 *
 * @property-read \App\Girl $girl
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @mixin \Eloquent
 */
class Topic extends Model
{
    protected $fillable = ['title', 'content', 'link', 'link_md5', 'girl_id'];

    public function girl()
    {
        return $this->belongsTo('App\Girl');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}