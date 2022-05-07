<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::all() ;

        return view('Site.Tag.index', [

            'tags' => $tags
        ]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Site.Tag.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {

        $form = $request->all() ;

        if($tag = Tag::create($form)){

            return back()->with([

                'success' => true,
                'message' => 'Tudo Certo!! Nova Tag criada com SUCESSO.'
            ]) ;
        }else return back()->with([

            'error' => true,
            'message' => 'Sinto Muito, Algo deu errado.'
        ]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {

        return view('Site.Tag.edit', [

            'tag' => $tag
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {

        $form = $request->all() ;
        if($tag->update($form)){

            return redirect(route('tag-edit', $tag->slug))->with([

                'success' => true,
                'message' => 'Tudo Certo!! Tag alterada com SUCESSO.'
            ]) ;
        }else return redirect(route('tag-edit', $tag->slug))->with([

            'error' => true,
            'message' => 'Sinto Muito, Algo deu errado.'
        ]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {

        if($tag->delete())

            return back()->with([

                'success' => true,
                'message' => 'Tudo Certo!! Tag excluida com SUCESSO.'
            ]) ;
        else return back()->with([

            'error' => true,
            'message' => 'Sinto Muito, Algo deu errado.'
        ]) ;
    }
}
