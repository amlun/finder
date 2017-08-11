<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/11
 * Time: 上午10:07
 */

namespace App\Jobs;

use App\Photo;
use App\Topic;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use Storage;

/**
 * Class DeleteTopic
 * @package App\Jobs
 */
class DeleteTopic extends Job
{
    /**
     * @var Topic
     */
    protected $topic;

    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    public function handle()
    {
        try {
            if (Storage::disk('public')->exists($this->topic->cover)) {
                Storage::disk('public')->delete($this->topic->cover);
            }
            foreach ($this->topic->photos as $photo) {
                dispatch(new DeletePhoto($photo));
            }
            $this->topic->delete();
            Log::info('delete photo successful', ['topic_id' => $this->topic->id]);
        } catch (ModelNotFoundException $exception) {
            Log::notice('photo is not found', ['topic_id' => $this->topic->id]);
        }
    }
}