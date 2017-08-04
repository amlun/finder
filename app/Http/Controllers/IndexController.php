<?php
/**
 * Created by PhpStorm.
 * User: lunweiwei
 * Date: 2017/8/4
 * Time: 下午3:37
 */

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $images = Image::paginate(16);
        return view('welcome', ['images' => $images]);
    }
}