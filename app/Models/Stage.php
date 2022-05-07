<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'post_id',
        'type'
    ] ;

    public function post()
    {

        return $this->belongsTo(Post::class) ;
    }

    public function steps()
    {

        return $this->hasMany(Step::class) ;
    }
}
