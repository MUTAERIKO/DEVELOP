<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

use App\History;
use Carbon\Carbon;

use App\User;


class KijiController extends Controller
{
    public function add()
    {
        return view('admin.kiji.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Content::$rules);
        $content = new Content;
        $form = $request->all();
        
       if (isset($form['image'])){
        $path = $request->file('image')->store('public/image');
        $content -> image_path = basename($path);
        } else {
            $content->image_path = null;
        }
        
        
        unset($form['_token']);
        unset($form['image']);
        
        $content->fill($form);
        $content->save();
        
    
        return redirect('admin/kiji/');
       //return redirect('admin/kiji/create');
      
    }
    
        public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title !='') {
            $posts = Content::where('title','like','%'.$cond_title.'%')->orderBy('created_at','desc')->get();
        } else {
            $posts = Content::all()->sortByDesc('updated_at');
        }
        return view('admin.kiji.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    
    
      public function show(Request $request)
  {
      // News Modelからデータを取得する
      $content = Content::find($request->id);
      
      if (empty($content)) {
        abort(404);    
      }
      return view('admin.kiji.show', ['content_form' => $content]);
  }
  
  
  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $content = Content::find($request->id);
      
      if (empty($content)) {
        abort(404);    
      }
      return view('admin.kiji.edit', ['content_form' => $content]);
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

      return redirect('admin/kiji/');
  }
  
  
    public function delete(Request $request)
  {
      $content = Content::find($request->id);
      $content = delete();

      return redirect('admin/kiji/');
  }
}


