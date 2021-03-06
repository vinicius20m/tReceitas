<?php

namespace App\Models;

use Illuminate\Support\Str ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'title',
        'slug',
        'description'
    ] ;

    public function posts()
    {

        return $this->hasMany(Post::class) ;
    }

    protected $dates = [

        'deleted_at'
    ] ;

    public function setTitleAttribute($title)
    {

        $this->attributes['title'] = $title ;
        $slug = Str::slug($title) ;
        $myself = $this::find($this->id) ;

        if($myself){

            if($myself->title == $title)
                return ;
        }

        $occurrences = $this::withTrashed()->whereTitle($title)->latest('id')->get() ;
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
}
