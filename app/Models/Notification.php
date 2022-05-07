<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'user_id',
        'post_id',
        'type'
    ] ;

    public function post()
    {

        return $this->belongsTo(Post::class) ;
    }

    public function user()
    {

        return $this->belongsTo(User::class) ;
    }

    //

    public function addressees()
    {

        return $this->belongsToMany(User::class, 'user_notifications') ;
    }

    protected $dates = [

        'deleted_at'
    ] ;
}
