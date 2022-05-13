<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title') ;
            $table->string('slug')->unique() ;
            $table->string('description')->nullable() ;
            $table->integer('portions')->nullable() ;
            $table->boolean('private')->default(0) ;
            $table->foreignId('user_id')->constrained() ;
            $table->foreignId('category_id')->constrained() ;
            $table->text('image')->nullable() ;
            $table->timestamps();
            $table->softDeletes() ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
