<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInteractionsController extends Controller
{

    public function follow(Request $request)
    {

        $f_id = $request->get('following_id') ;
        $m_id = $request->get('my_id') ;
        $user = User::find($m_id) ;
        if($user){

            $following = $user->following->where('id', '=', $f_id) ;
            if($following->count() > 0){

                $user->following()->detach($f_id) ;
            }
            else
                $user->following()->attach($f_id) ;
        }


        return response()->json([
            'message' => 'sucesso',
            'meu_id' => $m_id,
            'seguindo_id' => $f_id
        ], 200) ;
    }

    public function favorite(Request $request)
    {

        $post_id = $request->get('post_id') ;
        $user_id = $request->get('user_id') ;
        $user = User::find($user_id) ;
        if($user){

            $favorites = $user->favoritePosts->where('id', '=', $post_id) ;
            if($favorites->count() > 0){

                $user->favoritePosts()->detach($post_id) ;
            }
            else
                $user->favoritePosts()->attach($post_id) ;
        }


        return response()->json([
            'message' => 'sucesso',
            'meu_id' => $user_id,
            'post_id' => $post_id
        ], 200) ;
    }

    public function like(Request $request)
    {

        $user_id = $request->get('user_id') ;
        $post_id = $request->get('post_id') ;
        $value = $request->get('value') ;
        $remove = $request->get('remove') ;

        $user = User::find($user_id) ;

        $likeRR = [] ;
        foreach($user->likedPosts as $like){

            $likeRR[$like->id] = [] ;
        }
        $likeRR[$post_id] = ['value' => $value?1:0] ;

        if($remove)
            $user->likedPosts()->detach($post_id) ;
        else
            $user->likedPosts()->sync($likeRR) ;


        return response()->json([

            'message' => $remove?'Neutro':($value?'Gostei':'Não Gostei'),
            'post' => $post_id,
            'user' => $user_id,
            // 'likes' => response()->json($likeRR)
        ], 200) ;
    }

    public function comment(Request $request)
    {

        $post = $request->all() ;

        $comment = Comment::create($post) ;

        return response()->json([

            'message' => 'sucesso',
            'content' => $comment->content,
            'comment_id' => $comment->id
        ], 200) ;
    }

    public function commentRemove(Request $request)
    {

        $user_id = $request->get('user_id') ;
        $comment_id = $request->get('comment_id') ;

        $comment = Comment::find($comment_id) ;
        if($comment->user->id == $user_id)
            $comment->delete() ;
        else return response()->json([

            'message' => 'acesso negado',
        ], 400) ;

        return response()->json([

            'message' => 'sucesso',
        ], 200) ;
    }
}
