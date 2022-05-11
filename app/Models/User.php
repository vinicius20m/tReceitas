<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes ;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'slug',
        'email',
        'about',
        'password',
    ];

    // HAS MANY

    public function posts()
    {

        return $this->hasMany(Post::class) ;
    }

    public function actions()
    {

        return $this->hasMany(Notification::class) ;
    }

    public function comments()
    {

        return $this->hasMany(Comment::class) ;
    }

    // MANY TO MANY

    public function likedPosts()
    {

        return $this->belongsToMany(Post::class, 'post_likes')->withPivot(['value']) ;
    }

    public function favoritePosts()
    {

        return $this->belongsToMany(Post::class, 'favorite_posts') ;
    }

    public function notifications()
    {

        return $this->belongsToMany(Notification::class, 'user_notifications') ;
    }

    public function followers()
    {

        return $this->belongsToMany(User::class, 'user_followers', 'user_id', 'follower_id') ;
    }

    public function following()
    {

        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'user_id') ;
    }

    //

    protected $dates = [

        'deleted_at'
    ] ;

    public function setNameAttribute($name)
    {

        $this->attributes['name'] = $name ;
        $slug = Str::slug($name) ;
        $myself = $this::find($this->id) ;

        if($myself){

            if($myself->name == $name)
                return ;
        }

        $occurrences = $this::withTrashed()->whereName($name)->latest()->get() ;
        $count = $occurrences->count() ;
        if($count > 0){
            if($count > 1)
                $slug = $this::getSlug($occurrences->first()->slug, $slug) ;
            else
            if($occurrences->first()->slug == $slug)
                $slug .= '-2' ;
            else
                $slug = $this::getSlug($occurrences->first()->slug, $slug) ;
        }


        $this->attributes['slug'] = $slug ;
    }

    private static function getSlug($refSlug, $oriSlug)
    {

        $rrSlug = explode('-', $refSlug) ;
        $c = (int)$rrSlug[count($rrSlug)-1] ;
        return $oriSlug . '-'. ($c+1) ;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
