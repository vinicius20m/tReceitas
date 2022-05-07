<?php

namespace App\Models;

use Illuminate\Support\Str ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'title',
        'slug',
        'description',
        'portions',
        'private',
        'category_id',
        'user_id'
    ] ;

    // BELONGS TO

    public function category()
    {

        return $this->belongsTo(Category::class) ;
    }

    public function user()
    {

        return $this->belongsTo(User::class) ;
    }

    // HAS MANY

    public function stages()
    {

        return $this->hasMany(Stage::class) ;
    }

    public function actions()
    {

        return $this->hasMany(Notification::class) ;
    }

    // MANY TO MANY

    public function tags()
    {

        return $this->belongsToMany(Tag::class, 'post_tags') ;
    }

    public function comments()
    {

        return $this->belongsToMany(User::class, 'post_comments')->withPivot(['content']) ;
    }

    public function likes()
    {

        return $this->belongsToMany(User::class, 'post_likes')->withPivot(['value']) ;
    }

    public function favorites()
    {

        return $this->belongsToMany(User::class, 'favorite_posts');
    }

    //

    protected $dates = [

        'deleted_at'
    ] ;

    public function setTitleAttribute($title)
    {

        $this->attributes['title'] = $title ;
        $slug = Str::slug($title) ;

        $occurrences = $this::withTrashed()->whereTitle($title)->get() ;
        $count = $occurrences->count() ;
        if($count > 0)
            $slug .= '-'.($count+1) ;

        $this->attributes['slug'] = $slug ;
    }
}
