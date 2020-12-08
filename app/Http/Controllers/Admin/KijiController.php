<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

use App\History;
use Carbon\Carbon;

use App\User;
use App\Question;
use App\Mail\SendMail;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;


class KijiController extends Controller
{
    public function add()
    {
        $user = Auth::user();
        $user_name = $user->name;
        var_dump($user_name);

        return view('admin.kiji.create',compact('user_name'));
    }
    
    
// blade.phpの<form action>から</form>までのinputタグで呼んだものの動きを表記
// $requestがそれらを呼んできている
    public function create(Request $request)
    {
        // Content.phpで表示したrulesとのバリデートを行う
        $request->validate(Content::$rules);
        // 新規コンテンツを$contentとする
        $content = new Content;
        // インプットタグで呼んできたもの（$request）を全てフォームに入れる
        $form = $request->all();
        
        // 画像の処理
        // もしformにimageが存在したら〜
       if (isset($form['image'])){
           
        //   「インプットタグから呼んできたfileのimageをstoreで格納する」っているのを$pathで定義する
        $path = $request->file('image')->store('public/image');
        // 上記の$pathをファイルの名前として呼んで、（$content -> image_path）で定義する
        $content -> image_path = basename($path);
        // (image)が存在しなければ、（$content -> image_path）は空欄で良いとする
        } else {
            $content->image_path = null;
        }
        
        // formでは['_token']が取れるので、取り除く。今回はimageも使用しないので取り除く。
        unset($form['_token']);
        unset($form['image']);
        
        // 作成したデータをフォームにいれて
        $content->fill($form);
        // ログイン時のidデータを、作成したデータのuser_idに紐付ける
        $content->user_id = Auth::id();
        // 作成したデータを保存する
        $content->save();
        
        // admin/kiji/にリダイレクトさせる
        return redirect('/');
       //return redirect('admin/kiji/create');
      
    }
    
        public function index(Request $request)
    {
        
        // <form action="{{ action('Admin\KijiController@index')〜で入れたinputを
        // requestで読み込み、＄cond_titleと新たに定義した
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
      // Contents Modelからデータを取得する
      $content = Content::find($request->id);
      
      if (empty($content)) {
        abort(404);    
      }
      
      
      $user = Auth::user();
        $user_name = $user->name;
        var_dump($user_name);
    
      return view('admin.kiji.show', ['content_form' => $content],compact('user_name'));
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
  
  
//   コメント追加
public function toukou(Request $request, $id)
    {
        $this->validate($request,Question::$rules);
        $question = new Question;
        $form = $request->all();
        
        unset($form['_token']);
        $question->fill($form);
        $question->save();
        
        
        // コメントの投稿があったら、この記事を投稿した人にメールを配信して知らせたい
        $user = Auth::user();
        // Mail::to($user)->send(new Question($toukou));
        $content = $question->content;
        $data = [
            'subject' => 'コメントが投稿されました',
            'toukou' => $question->toukou,
            'template' => 'email.reply',
            'name' => 'システムメール',
            'email' => 'aaa@XXX.com',
            'title' => $content->title,
            'reply_name' => $user->name,
        ];
        Mail::to($question->content->user->email)->send(new SendMail($data));

        return redirect('kiji/show?id=' . $id);
    }
    
    
    public function toukoudelete($content_id, $question_id)
  {
      $question = Question::find($question_id);
      $question->delete();

      return redirect('kiji/show?id=' . $content_id);
  }
  
  
    public function delete(Request $request)
  {
      $content = Content::find($request->id);
      $content->delete();

      return redirect('admin/kiji/');
  }
  
  
}


