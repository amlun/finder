<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/1
 * Time: 上午10:22
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBreadController as BaseVoyagerBreadController;

class AlbumController extends BaseVoyagerBreadController
{
    //
    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('delete_' . $dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        // Delete Translations, if present
        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }

        // 删除相册相关的照片
        foreach ($data->photos AS $photo) {
            $this->deleteFileIfExists($photo->path);
            $photo->delete();
        }

        $this->deleteFileIfExists($data->cover);

        $data = $data->destroy($id)
            ? [
                'message' => "Successfully Deleted {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]
            : [
                'message' => "Sorry it appears there was a problem deleting this {$dataType->display_name_singular}",
                'alert-type' => 'error',
            ];

        return back()->with($data);
    }
}