<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/1
 * Time: 上午10:22
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBreadController as BaseVoyagerBreadController;

class GirlController extends BaseVoyagerBreadController
{
    public function destroy(Request $request, $id)
    {
        $message = [
            'message' => "Sorry Girl is not allowed to delete",
            'alert-type' => 'error',
        ];

        return back()->with($message);
    }
}