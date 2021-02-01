<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Favorite;
use Auth;
use App\Content;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        // $id = Auth::user()->id;
        $content_id = $request->content_id;
        
        if(Auth::user()->favorites()->get()->pluck("content_id")->contains($content_id) ){
            // いいねしている場合
            $favorite = Favorite::where('content_id', $content_id)->where('user_id', Auth::user()->id)->delete();

            
        }else{
            // いいねしてない場合
            $favorite = new Favorite;
            $favorite->content_id = $content_id;
            $favorite->user_id = Auth::user()->id;
            $tst=$favorite->save();
        }
        // $favorite = new Favorite;
        // $content = Content::findOrFail($content_id);
        // //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        // $postLikesCount = $content->loadCount('likes')->likes_count;

        // // 空でない（既にいいねしている）なら
        // if ($favorite->like_exist($id, $content_id)) {
        //     //likesテーブルのレコードを削除
        //     $favorite = Favorite::where('content_id', $content_id)->where('user_id', $id)->delete();
        // } else {
        //     //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
        //     $favorite = new Favorite;
        //     $favorite->content_id = $request->content_id;
        //     $favorite->user_id = Auth::user()->id;
        //     $favorite->save();
        // }

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $content = Content::findOrFail($content_id);
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $content->favorites()->count();
        $json = [
            'count' => $postLikesCount,
            'content_id' => $content_id
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }
    
}
