<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/2
 * Time: 上午11:04
 */

namespace App\Providers;

use TCG\Voyager\Facades\Voyager as VoyagerFacade;
use TCG\Voyager\VoyagerServiceProvider as BaseVoyagerServiceProvider;

class VoyagerServiceProvider extends BaseVoyagerServiceProvider
{
    protected function registerFormFields()
    {
        VoyagerFacade::addFormField("App\\FormFields\\LinkHandler");
        parent::registerFormFields();
    }
}