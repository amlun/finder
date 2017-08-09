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
 * @mixin \Eloquent
 */
class Photo extends Model
{
    protected $fillable = ['title', 'url', 'url_md5', 'path', 'seq'];

    public function photoable()
    {
        return $this->morphTo();
    }
}