<?php

namespace App\Console;

use App\Console\Commands\CrawlDouban;
use App\Console\Commands\CrawlGirlAlbum;
use App\Console\Commands\CrawlImage;
use App\Console\Commands\Test;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CrawlDouban::class,
        CrawlGirlAlbum::class,
        CrawlImage::class,
        Test::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('crawl:douban group --url="https://www.douban.com/group/haixiuzu/"')->hourly();
        $schedule->command('crawl:douban group --url="https://www.douban.com/group/meituikong/"')->hourlyAt(10);
        $schedule->command('crawl:douban group --url="https://www.douban.com/group/bw0766/"')->hourlyAt(20);
        $schedule->command('crawl:douban group --url="https://www.douban.com/group/63686/"')->hourlyAt(30);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/510760/"')->hourly();
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/561425/"')->hourly();
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/516876/"')->hourly();
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/481977/"')->hourly();
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/515085/"')->hourly();
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/368701/"')->hourly();
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/196602/"')->hourly();
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/531651/"')->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
