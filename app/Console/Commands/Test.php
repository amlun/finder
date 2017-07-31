<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/28
 * Time: 下午2:59
 */

namespace App\Console\Commands;

use App\Jobs\Crawler;
use App\Photo;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For crawl test.';


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $photos = Photo::where('id', '>', 7210)->cursor();

        foreach ($photos AS $photo) {
            $photo->path = Crawler::localImagePath($photo->link);
            $photo->save();
            $this->comment('update photo ' . $photo->link);
        }
    }
}