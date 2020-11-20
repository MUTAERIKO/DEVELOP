<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Content;

use App\History;
use Carbon\Carbon;

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
    
      public function show(Request $request)
  {
      // News Modelからデータを取得する
      $content = Content::find($request->id);
      
      if (empty($content)) {
        abort(404);    
      }
      return view('kiji.show', ['content_form' => $content]);
  }
  
  
  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $content = Content::find($request->id);
      
      if (empty($content)) {
        abort(404);    
      }
      return view('kiji.edit', ['content_form' => $content]);
  }
  
  
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Content::$update_rules);
      // News Modelからデータを取得する
      $content = Content::find($request->id);
      // 送信されてきたフォームデータを格納する
      $content_form = $request->all();
      
      
        if($request->remove == 'true'){
            $content_form['image_path'] = null;
        }elseif ($request->file('image')){
                $path = $request->file('image')->store('public/image');
                $content_form['image_path'] = basename($path);
        } else {
                $content_form['image_path'] = $content->image_path;
                    }


      unset($content_form['image']);
      unset($content_form['remove']);
      unset($content_form['_token']);

      // 該当するデータを上書きして保存する
      $content->fill($content_form)->save();
      
      $history = new History;
      $history->content_id = $content->id;
      $history->edited_at = Carbon::now();
      $history->save();

      return redirect('/');
  }
  
}
