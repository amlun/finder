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
    /**
     * @var Photo
     */
    protected $photo;

    public function __construct($photo)
    {
        $this->photo = $photo;
    }

    public function handle()
    {
        try {
            if (Storage::disk('public')->exists($this->photo->path)) {
                Storage::disk('public')->delete($this->photo->path);
            }
            $this->photo->delete();
            Log::info('delete photo successful', ['photo_id' => $this->photo->id]);
        } catch (ModelNotFoundException $exception) {
            Log::notice('photo is not found', ['photo_id' => $this->photo->id]);
        }
    }
}