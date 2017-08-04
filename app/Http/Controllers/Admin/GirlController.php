<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/1
 * Time: 上午10:22
 */

namespace App\Http\Controllers\Admin;

use App\Jobs\Crawler\DoubanAlbumList;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBreadController as BaseVoyagerBreadController;

class GirlController extends BaseVoyagerBreadController
{
    // 抓取这个Girl的相册
    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('delete_' . $dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        $album_link = $data->link . 'photos';

        $this->dispatch(new DoubanAlbumList($album_link));

        $message = [
            'message' => "Successfully Crawl Girl's Album",
            'alert-type' => 'success',
        ];

        return back()->with($message);
    }
}