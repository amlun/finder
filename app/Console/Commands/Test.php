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
//        dispatch(new Crawler\Douban\Topic(105928969));
        dispatch(new Crawler\Douban\Group(510760));
    }
}