<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Models\Stage;
use App\Models\Step;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all() ;
        $tags = Tag::all() ;

        return view('Site.Post.create', [

            'tags' => $tags,
            'categories' => $categories
        ]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $form = $request->all() ;
        $form['private'] = (!isset($form['private']))? 0 : 1;
        $form['user_id'] = Auth::id() ;

        // dd($form) ;

        if($post = Post::create($form)){

            // TAGS STORE
            if(isset($form['tags']))
                foreach ($form['tags'] as $k => $tag)
                    $post->tags()->attach([$tag => [

                        'created_at' => $post->created_at,
                        'updated_at' => $post->updated_at
                    ]])
                ;
            ;

            // INGREDIENTS STORE
            if(isset($form['ingredientTitle']))
            foreach ($form['ingredientTitle'] as $key => $ingredient) {

                if(!empty($form['ingredient-step'][$key])){

                    $stage = Stage::create([

                        'title' => $ingredient,
                        'post_id' => $post->id,
                        'type' => 'INGREDIENT'
                    ]) ;

                    foreach($form['ingredient-step'][$key] as $step)
                        if(!empty($step))
                        Step::create([

                            'stage_id' => $stage->id,
                            'content' => $step
                        ])
                    ;
                }
            }

            // PREPARATIONS STORE
            if(isset($form['preparationTitle']))
            foreach ($form['preparationTitle'] as $key => $preparation) {

                if(!empty($form['preparation-step'][$key])){

                    $stage = Stage::create([

                        'title' => $preparation,
                        'post_id' => $post->id,
                        'type' => 'PREPARATION'
                    ]) ;

                    foreach($form['preparation-step'][$key] as $step)
                        if(!empty($step))
                        Step::create([

                            'stage_id' => $stage->id,
                            'content' => $step
                        ])
                    ;
                }
            }

            return back()->with([

                'success' => true,
                'message' => 'Tudo Certo!! Nova Receita criada com SUCESSO.'
            ]) ;
        }else return back()->with([

            'error' => true,
            'message' => 'Sinto Muito, Algo deu errado.'
        ]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $post->load(['tags', 'user', 'category', 'stages.steps']) ;
        $ingredients = $post->stages->where('type', 'INGREDIENT') ;
        $preparations = $post->stages->where('type', 'PREPARATION') ;

        return view('Site.Post.show', [

            'ingredients' => $ingredients,
            'preparations' => $preparations,
            'post' => $post
        ]) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categories = Category::all() ;
        $tags = Tag::all() ;

        $post->load(['tags', 'user', 'category', 'stages.steps']) ;
        $ingredients = $post->stages->where('type', 'INGREDIENT') ;
        $preparations = $post->stages->where('type', 'PREPARATION') ;

        return view('Site.Post.edit', [

            'ingredients' => $ingredients,
            'preparations' => $preparations,
            'categories' => $categories,
            'tags' => $tags,
            'post' => $post
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $form = $request->all() ;
        $form['private'] = (!isset($form['private']))? 0 : 1 ;

        if($post->update($form)){

            if(isset($form['tags'])){

                $tags = [] ;
                foreach ($form['tags'] as $k => $tag)

                    $tags[$tag] = [
                        'created_at' => $post->updated_at,
                        'updated_at' => $post->updated_at
                    ]
                ;
                $post->tags()->sync($tags) ;
            }

            foreach($post->stages as $stage)
                $stage->delete()
            ;

            // INGREDIENTS STORE
            if(isset($form['ingredientTitle']))
            foreach ($form['ingredientTitle'] as $key => $ingredient) {

                if(isset($form['ingredient-step'][$key])){

                    $stage = Stage::create([

                        'title' => $ingredient,
                        'post_id' => $post->id,
                        'type' => 'INGREDIENT'
                    ]) ;

                    foreach($form['ingredient-step'][$key] as $step)
                        Step::create([

                            'stage_id' => $stage->id,
                            'content' => $step
                        ])
                    ;
                }
            }

            // PREPARATIONS STORE
            if(isset($form['preparationTitle']))
            foreach ($form['preparationTitle'] as $key => $preparation) {

                if(isset($form['preparation-step'][$key])){

                    $stage = Stage::create([

                        'title' => $preparation,
                        'post_id' => $post->id,
                        'type' => 'PREPARATION'
                    ]) ;

                    foreach($form['preparation-step'][$key] as $step)
                        Step::create([

                            'stage_id' => $stage->id,
                            'content' => $step
                        ])
                    ;
                }
            }

            return redirect(route('post-edit', $post->slug))->with([

                'success' => true,
                'message' => 'Tudo Certo!! Receita alterada com SUCESSO.'
            ]) ;
        }else return redirect(route('post-edit', $post->slug))->with([

            'error' => true,
            'message' => 'Sinto Muito, Algo deu errado.'
        ]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if($post->delete())

            return redirect(route('begin'))->with([

                'success' => true,
                'message' => 'Tudo Certo!! Post excluida com SUCESSO.'
            ]) ;
        else return redirect(route('begin'))->with([

            'error' => true,
            'message' => 'Sinto Muito, Algo deu errado.'
        ]) ;
    }
}
