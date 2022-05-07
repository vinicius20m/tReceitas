<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [

        'stage_id',
        'content'
    ] ;

    public function stage()
    {

        return $this->belongsTo(Stage::class) ;
    }
}
