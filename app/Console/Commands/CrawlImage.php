<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/28
 * Time: 下午3:29
 */

namespace App\Console\Commands;

use App\Jobs\Crawler;
use Illuminate\Console\Command;

class CrawlImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:image {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Local the images or photos.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $url = $this->argument('url');
        $local_path = Crawler::localImagePath($url);
        dispatch(new Crawler\Image($url, $local_path));
    }
}