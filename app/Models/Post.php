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

    public function comments()
    {

        return $this->hasMany(Comment::class) ;
    }

    // MANY TO MANY

    public function tags()
    {

        return $this->belongsToMany(Tag::class, 'post_tags') ;
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
        $myself = $this::find($this->id) ;

        if($myself){

            if($myself->title == $title){

                // $this->attributes['slug'] = $slug ;
                return ;
            }
        }

        $occurrences = $this::withTrashed()->whereTitle($title)->latest()->get() ;
        $count = $occurrences->count() ;
        // dd($occurrences) ;
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
        // dd($c) ;
        return $oriSlug . '-'. ($c+1) ;
    }
}
