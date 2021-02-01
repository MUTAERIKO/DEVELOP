<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    

    public function content()
    {
      return $this->belongsTo('App\Content');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
    
    //いいねが既にされているかを確認
    public function like_exist($id, $content_id)
    {
$exist = Favorite::where('user_id', '=', $id)->where('content_id', '=', $content_id)->get();
        if (!$exist->isEmpty()) {
            return true;
        } else {
            return false;
        }
}
}