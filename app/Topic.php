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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 * @mixin \Eloquent
 */
class Topic extends Model
{
    protected $fillable = ['girl_id', 'title', 'cover', 'content', 'url', 'url_md5'];

    public function girl()
    {
        return $this->belongsTo('App\Girl');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }
}