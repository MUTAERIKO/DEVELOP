<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Content;

class KijiController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title !='') {
            $posts = Content::where('title','like','%'.$cond_title.'%')->orderBy('created_at','desc')->get();
        } else {
            $posts = Content::all()->sortByDesc('updated_at');
        } 
        return view('kiji.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
}
