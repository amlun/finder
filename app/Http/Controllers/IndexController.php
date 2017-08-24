<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/4
 * Time: 下午3:37
 */

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $photos = Photo::latest()->paginate(100);
        foreach ($photos as $photo) {
            $photo_path[] = url('/storage/resize/medium/' . $photo->path);
        }
        return view('index', ['photos' => $photos, 'photo_path' => json_encode($photo_path)]);
    }
}