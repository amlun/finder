<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/2
 * Time: 上午11:04
 */

namespace App\Providers;

use App\Aip\AipImageCensor;
use Illuminate\Support\ServiceProvider;

class AipServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('AIP', function () {
            $config = config('aip');
            return new AipImageCensor($config['app_id'], $config['api_key'], $config['secret_key']);
        });
    }
}