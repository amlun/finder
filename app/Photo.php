<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 上午11:19
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Photo
 *
 * @property-read \App\Album $album
 * @mixin \Eloquent
 */
class Photo extends Model
{
    protected $fillable = ['link', 'link_md5', 'path'];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}