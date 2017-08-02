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

class PhotoController extends BaseVoyagerBreadController
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

        $this->deleteFileIfExists($data->path);

        $data = $data->destroy($id)
            ? [
                'message' => "Successfully Deleted {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]
            : [
                'message' => "Sorry it appears there was a problem deleting this {$dataType->display_name_singular}",
                'alert-type' => 'error',
            ];

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }
}