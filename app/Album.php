<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 上午11:17
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Album
 *
 * @property-read \App\Girl $girl
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 * @mixin \Eloquent
 */
class Album extends Model
{
    protected $fillable = ['cover', 'title', 'link', 'link_md5', 'girl_id'];

    public function girl()
    {
        return $this->belongsTo('App\Girl');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}