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

    // MANY TO MANY

    public function commentedPosts()
    {

        return $this->belongsToMany(Post::class, 'post_comments')->withPivot(['content']) ;
    }

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

        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'user_id') ;
    }

    public function following()
    {

        return $this->belongsToMany(User::class, 'user_followers', 'user_id', 'follower_id') ;
    }

    //

    protected $dates = [

        'deleted_at'
    ] ;

    public function setNameAttribrute($name)
    {

        $this->attributes['name'] = $name ;
        $slug = Str::slug($name) ;

        $occurrences = $this::withTrashed()->whereName($name)->get() ;
        $count = $occurrences->count() ;
        if($count > 0)
            $slug .= '-'.($count+1) ;

        $this->attributes['slug'] = $slug ;
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
