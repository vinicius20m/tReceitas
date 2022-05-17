<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show(User $user)
    {

        if(isset($user))
            $user->load(['posts']) ;
        else return back()->with([

            'error' => true,
            'message' => 'Sinto Muito, Usuário não encontrado.'
        ]);

        return (Auth::id() == $user->id)
        ?
            view('Site.Profile.my-profile', [

                'user' => $user
            ])
        :
            view('Site.Profile.show', [

                'user' => $user
            ])
        ;
    }

    public function update(Request $request, User $user)
    {

        // CHECKS IF THE USER IS LOGED IN
        if(!Auth::check())
            return back()->with([

                'error' => true,
                'message' => 'Sinto Muito, Você precisa entrar com sua conta.'
            ])
        ;
        //CHECKS IF THE USER IS TRYING TO UPDATE THEIR OWN ACCOUNT
        if(!isset($user) || $user->id != Auth::id())
        return back()->with([

            'error' => true,
            'message' => 'Sinto Muito, Usuário não encontrado.'
        ]);

        $form = [

            'name' => $request->input('name'),
            'about' => $request->input('about'),
            'image' => $user->image
        ] ;

        // IMAGE
        $file = $request->image ;
        if(isset($file)){

            $extension = $file->extension() ;
            $validExtensions = [
                'png',
                'jpg',
                'jpeg',
                'jfif'
            ];

            if(in_array($extension, $validExtensions)){

                $name = 'user-image_'. $user->id. '.'. $extension ;
                // unlink(public_path('images/posts/'.$post->image)) ;
                $file->move(public_path('images/users'), $name) ;
                $form['image'] = $name ;
            }else return back()->with([

                'error' => true,
                'message' => 'Sinto Muito, Formato de imagem não suportado.'
            ]);
        }

        if($user->update($form))
            return redirect(route('profile-show', $user->slug))->with([

                'success' => true,
                'message' => 'Tudo Certo!! Suas informações foram salvas com SUCESSO.'
            ]) ;
        else return redirect(route('profile-show', $user->slug))->with([

            'error' => true,
            'message' => 'Sinto Muito, Algo deu errado.'
        ]);
    }

    // public function destroy(User $user)
    // {

    //     // return view() ;
    // }

    public function posts()
    {

        if(!Auth::check())
            return back()->with([

                'error' => true,
                'message' => 'Sinto Muito, Você precisa entrar com sua conta.'
            ])
        ;

        $user = Auth::user() ;
        $posts = Post::where('user_id','=', $user->id)->latest('id')->paginate(15) ;

        return view('Site.Profile.my-posts', [

            'user' => $user,
            'posts' => $posts
        ]) ;
    }

    public function favorites()
    {

        if(!Auth::check())
            return back()->with([

                'error' => true,
                'message' => 'Sinto Muito, Você precisa entrar com sua conta.'
            ])
        ;

        $user = Auth::user() ;

        return view('Site.Profile.favorites', [

            'user' => $user
        ]) ;
    }

    public function following()
    {

        if(!Auth::check())
            return back()->with([

                'error' => true,
                'message' => 'Sinto Muito, Você precisa entrar com sua conta.'
            ])
        ;

        $user = Auth::user() ;

        return view('Site.Profile.following', [

            'user' => $user
        ]) ;
    }
}
