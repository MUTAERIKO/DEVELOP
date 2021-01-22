<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Content;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function contents()
    {
        return $this->hasMany('App\Content');
    } 
    
    public function favorites()
    {
        return $this->belongsToMany(Content::class, 'favorites', 'user_id', 'content_id')->withTimestamps();
    }

    public function favorite($contentId)
    {
        $exist = $this->is_favorite($contentId);

        if($exist){
            return false;
        }else{
            $this->favorites()->attach($contentId);
            return true;
        }
    }

    public function unfavorite($contentId)
    {
        $exist = $this->is_favorite($contentId);

        if($exist){
            $this->favorites()->detach($contentId);
            return true;
        }else{
            return false;
        }
    }

    public function is_favorite($contentId)
    {
        return $this->favorites()->where('content_id',$contentId)->exists();
    }
    
}
