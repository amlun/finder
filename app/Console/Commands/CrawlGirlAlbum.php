<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/28
 * Time: 上午11:10
 */

namespace App\Console\Commands;


use App\Girl;
use App\Jobs\Crawler\DoubanAlbumList;
use Illuminate\Console\Command;
use Log;

class CrawlGirlAlbum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:girl:album {girl_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl the girl\'s albums.';


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $girl_id = $this->argument('girl_id');
        if (!empty($girl_id)) {
            $girl = Girl::findOrFail($girl_id);
            $this->_dispatch($girl);
        } else {
            Girl::chunk(200, function ($girls) {
                foreach ($girls as $girl) {
                    $this->_dispatch($girl);
                }
            });
        }
    }

    private function _dispatch($girl)
    {
        if (!empty($girl->link)) {
            $girl_album_link = $girl->link . 'photos';
            dispatch(new DoubanAlbumList($girl_album_link));
            Log::info('dispatch douban album list', ['link' => $girl_album_link]);
        }
    }
}