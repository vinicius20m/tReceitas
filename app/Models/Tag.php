<?php

namespace App\Models;

use Illuminate\Support\Str ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'title',
        'slug',
        'description'
    ] ;

    public function posts()
    {

        return $this->belongsToMany(Post::class, 'post_tags') ;
    }

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
