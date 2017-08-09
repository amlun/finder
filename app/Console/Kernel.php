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
        $schedule->command('crawl:douban group 433459')->everyFiveMinutes();
        $schedule->command('crawl:douban group 516876')->everyThirtyMinutes();
        $schedule->command('crawl:douban group 510760')->everyThirtyMinutes();


//        $schedule->command('crawl:douban group 63686')->hourlyAt(10);
//        $schedule->command('crawl:douban group 561425')->hourlyAt(15);
//        $schedule->command('crawl:douban group 481977')->hourlyAt(20);
//        $schedule->command('crawl:douban group 515085')->hourlyAt(20);

//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/bw0766/"')->hourlyAt(5);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/meituikong/"')->hourlyAt(5);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/368701/"')->hourlyAt(25);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/196602/"')->hourlyAt(25);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/531651/"')->hourlyAt(30);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/rouniu/"')->hourlyAt(30);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/kaopulove/"')->hourlyAt(35);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/407518/"')->hourlyAt(35);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/503950/"')->hourlyAt(40);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/446091/"')->hourlyAt(40);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/nanpengyou/"')->hourlyAt(45);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/542175/"')->hourlyAt(45);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/515085/"')->hourlyAt(50);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/face2face/"')->hourlyAt(50);
//        $schedule->command('crawl:douban group --url="https://www.douban.com/group/294735/"')->hourlyAt(55);
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
