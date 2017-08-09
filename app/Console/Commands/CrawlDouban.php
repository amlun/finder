<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/7/27
 * Time: 下午2:18
 */

namespace App\Console\Commands;

use App\Jobs\Crawler\Douban\Group;
use App\Jobs\Crawler\Douban\Topic;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class CrawlDouban extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:douban {type} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the douban crawler';

    protected $_types = [
        'group' => Group::class,
        'topic' => Topic::class,
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $type = $this->argument('type');
        $cls = Arr::get($this->_types, $type);
        if (isset($cls)) {
            $url = $this->option('url');
            dispatch(new $cls($url));
        }
    }
}