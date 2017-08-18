<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/18
 * Time: 下午4:06
 */

namespace App\Console\Commands;


use App\Topic;
use Illuminate\Console\Command;

class DeleteTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:topic {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For delete crawl topic.';


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $id = $this->argument('id');
        $topic = Topic::findOrFail($id);
        dispatch(new \App\Jobs\DeleteTopic($topic));
    }
}