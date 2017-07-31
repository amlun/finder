<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/28
 * Time: 下午3:29
 */

namespace App\Console\Commands;


use App\Image;
use App\Photo;
use App\Jobs\Crawler;
use Illuminate\Console\Command;
use Log;

class CrawlImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:image {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Local the images or photos.';

    private static $_map = [
        'image' => Image::class,
        'photo' => Photo::class,
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $type = $this->argument('type');
        $cls = self::$_map[$type];
        if (empty($cls)) {
            throw new \InvalidArgumentException('invalid argument type');
        }
        $cls::chunk(200, function ($images) {
            foreach ($images as $image) {
                $this->_dispatch($image);
            }
        });
    }

    private function _dispatch($image)
    {
        if (!empty($image->link) && empty($image->path)) {
            $local_path = Crawler::localImagePath($image->link);
            dispatch(new Crawler\Image($image->link, $local_path));
            Log::info('dispatch image job', ['link' => $image->link]);
            $image->path = $local_path;
            $image->save();
        }
    }
}