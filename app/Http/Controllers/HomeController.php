<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function home(Request $request)
    {

        $search = $request->search ;
        $filterC = Category::whereSlug($request->filterC)->first() ;
        $filterT = Tag::whereSlug($request->filterT)->first()  ;
        if($search)
            $posts = Post::where([
                ['private', '=', '0'],
                ['title', 'like', '%'.$search.'%']
            ])->latest('id')->paginate(15)->appends(['search' => $search]) ;
        elseif($filterC)
            $posts = Post::publics()->where('category_id', '=' , $filterC->id)->latest('id')->paginate(15)->appends(['filterC' => $request->filterC]) ;
        elseif($filterT)
            $posts = Post::publics()->whereHas('tags', function($query) use($filterT){
                $query->where('tags.id', '=', $filterT->id);
            })->latest('id')->paginate(15)->appends(['filterT' => $request->filterT]) ;
        else
            $posts = Post::publics()->latest('id')->paginate(15) ;

            // dd($search) ;
        $mainTitle = $search? 'Buscando Por: '. $search : ($filterC? 'Fitrando pela categoria: '. $filterC->title : ($filterT? 'Filtrando pela tag: '. $filterT->title : 'Ultimas Adicionadas')) ;

        $categories = Category::all() ;
        $tags = Tag::all() ;

        return view('Site.index', [

            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'mainTitle' => $mainTitle
        ]);
    }
}
