<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/26
 * Time: 下午6:11
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Girl
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Album[] $albums
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Topic[] $topics
 * @mixin \Eloquent
 */
class Girl extends Model
{
    protected $fillable = ['name', 'head', 'link', 'link_md5'];

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    public function albums()
    {
        return $this->hasMany('App\Album');
    }
}