<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/11
 * Time: 上午10:07
 */

namespace App\Jobs;

use App\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use Storage;

/**
 * Class DeletePhoto
 * @package App\Jobs
 */
class DeletePhoto extends Job
{
    protected $photo_id;

    public function __construct($photo_id)
    {
        $this->photo_id = $photo_id;
    }

    public function handle()
    {
        try {
            $photo = Photo::findOrFail($this->photo_id);
            if (Storage::disk('public')->exists($photo->path)) {
                Storage::disk('public')->delete($photo->path);
            }
            $photo->delete();
            Log::info('delete photo successful', ['photo_id' => $this->photo_id]);
        } catch (ModelNotFoundException $exception) {
            Log::notice('photo is not found', ['photo_id' => $this->photo_id]);
        }
    }
}