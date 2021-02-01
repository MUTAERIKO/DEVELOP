<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Content;

use App\History;
use Carbon\Carbon;
use App\Favorite;
use App\Question;


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
    
        
        $data = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できます。
        $contents = Content::withCount('favorites')->orderBy('created_at', 'desc')->paginate(10);
        $like_model = new Favorite;

        $data = [
                'content' => $contents,
                'like_model'=>$like_model,
            ];
    
        return view('kiji.index', ['posts' => $posts, 'cond_title' => $cond_title, "like_model" => $like_model,"content" => $contents]);

        // return view('kiji.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
      public function show($id)
  {
      // News Modelからデータを取得する
      $content = Content::find($id);
      
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
 public function toukou(Request $request)
  {
      // 投稿画面の追加
      $this->validate($request, Question::$rules);
      $question = new Question;  
      $form = $request->all();
      
      unset($form['_token']);
      $question->fill($form)->save();
      
      
      return redirect('kiji/show/' . $request->content_id);
  }
  
  public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $content_id = $request->content_id;
        $like = new Like;
        $post = Content::findOrFail($content_id);
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $content_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('content_id', $content_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->content_id = $request->content_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }
  
}
