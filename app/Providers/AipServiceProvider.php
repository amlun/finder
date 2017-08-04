<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/2
 * Time: 上午11:04
 */

namespace App\Providers;

use App\Aip\AipFace;
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
        $config = config('aip');
        
        $this->app->singleton('AipImageCensor', function () use ($config) {
            return new AipImageCensor($config['app_id'], $config['api_key'], $config['secret_key']);
        });

        $this->app->singleton('AipFace', function () use ($config) {
            return new AipFace($config['app_id'], $config['api_key'], $config['secret_key']);
        });
    }
}