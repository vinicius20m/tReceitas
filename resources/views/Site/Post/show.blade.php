@extends('Layouts.modelo2')

@section('content')

<div class="gap-40"></div>

<div class="row">
      <div class="col-md-12">
      <div class="row">
            <h1 class="column-title col-md-4">{{$post->title}}</h1>
            <a class="col-md-1" style="margin-top: 17px; color: #ffb600"
                  href="{{
                        route('begin')
                  }}"
            >Voltar</a>
      </div>

      <div class="row">

            <div class="col-md-6" >
                  Por : &nbsp&nbsp <a href="{{route('profile-show', $post->user->slug)}}" style="color: #ffb600">{{$post->user->name}}</a> &nbsp&nbsp&nbsp {{$post->created_at}}
            </div>
            <div class="col-md-6" >
                  @auth
                  @if (Auth::id() == $post->user_id)

                  <button
                        class="slim-button btn btn-outline-primary"
                        onclick="window.location='{{route('post-edit', $post->slug)}}'"
                  > <i class="bi bi-pencil-square"></i> Editar</button>
                  <button
                        data-target="#deletePostModal" data-toggle="modal"
                        style="margin-left: 30px"
                        class="slim-button btn btn-outline-danger"
                  > <i class="bi bi-trash3-fill"></i> Excluir</button>

                  <div class="modal fade" id="deletePostModal"
                        tabIndex="-1" role="dialog" aria-hidden="true"
                  >
                        <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 600px">
                              <div class="modal-content">
                              <div style="background: #b54c4c" class="modal-header">
                                    <h4 class="modal-title" id="modalLongTitle">Excluindo a Receita: <strong>{{$post->title}}</strong></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                              </div>
                              <div class="modal-body">

                                    <h2 class="text-center">Tem certeza que deseja excluir esta Receita?</h2>
                              </div>
                              <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                    <button
                                          type="button"
                                          class="btn btn-danger"
                                          data-dismiss="modal"
                                          onclick="window.location=
                                                '{{ route('post-destroy', $post->slug) }}'
                                          "
                                    >Sim</button>
                              </div>
                              </div>
                        </div>
                  </div>
                  @else
                  <div class="row">
                        <div class="col-md-7">
                              @if ($post->favorites->contains('id', Auth::id()))
                              <button id="favorite-btn" class="btn btn-warning" onclick="Favorite(false)">Retirar Favorito</button>
                              @else
                              <button id="favorite-btn" class="btn btn-warning" onclick="Favorite(true)">Marcar Favorito</button>
                              @endif
                        </div>
                        <div class="col-md-5">
                              @php

                                    $like = $post->likes()
                                          ->wherePivot('value', '=', 1)
                                          ->where('user_id', '=', Auth::id())
                                          ->count()
                                    ;

                                    $dislike = $post->likes()
                                          ->wherePivot('value', '=', 0)
                                          ->where('user_id', '=', Auth::id())
                                          ->count()
                                    ;
                              @endphp

                              <button
                                    id="like-btn"
                                    onclick="Like()"
                                    class="slim-button btn btn-outline-success"
                              ><i class="bi bi-hand-thumbs-up{{$like?'-fill':''}}"></i>Gostei</button>
                              <button
                                    id="dislike-btn"
                                    onclick="Dislike()"
                                    class="slim-button btn btn-outline-danger"
                                    style="margin-left: 25px"
                              ><i class="bi bi-hand-thumbs-down{{$dislike?'-fill':''}}"></i>Não Gostei</button>
                        </div>
                  </div>
                  @endif
                  @endauth
            </div>
      </div>

      <div class="gap-40"></div>

      <div class="error-container">

      @if ($errors->any())
            <div id="error-card" class="alert alert-danger error-container">
                  <a href="#error-card" class="close" data-dismiss="alert" aria-label="close"
                  id="hide">&times;</a>
                  <ul>
                  @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                  @endforeach
                  </ul>
            </div>
      @elseif(session('success'))
            <div id="success-card" class="alert alert-success">
                  <a href="#success-card" class="close" data-dismiss="alert" aria-label="close"
                  id="hide">&times;</a>
                  {{ session('message') }}
            </div>
      @elseif(session('error'))
            <div id="error-card" class="alert alert-danger">
                  <a href="#error-card" class="close" data-dismiss="alert" aria-label="close"
                  id="hide">&times;</a>
                  {{ session('message') }}
            </div>
      @endif
      </div>

      <div style="padding: 0px" class="form-group row">
            <div  class="col-md-8">
                  <h1>foto</h1>

            </div>
            <div class="form-group col-md-4">

                  <div class="row">
                        <h3 style="left: 37%; position: relative;">categoria</h3>
                  </div>
                  <a href="" style="font-size: 34px; color:#ffb600; margin-left: 10px">{{$post->category->title}}</a>

                  <div class="gap-40"></div>

                  @if ($post->portions > 0)

                  <div class="row">
                        <h3 style="left: 43%; position: relative;">rende</h3>
                  </div>
                  <a href="" style="font-size: 34px; color:#ffb600; margin-left: 10px">{{$post->portions}} {{$post->portions > 1 ? 'Porções' : 'Porção'}}</a>
                  @endif
            </div>
      </div>

      {{-- ------------------------------------------------------------------------------------------------------ --}}
      {{-- ------------------------------------------------------------------------------------------------------ --}}


      <div class="gap-40"></div>
      <div class="gap-20"></div>

      {{-- ------------------------------------------------------------------------------------------------------ --}}
      {{-- ------------------------------------------------------------------------------------------------------ --}}


      <div style="justify-content: center;" class="form-group row">
            <div class="col-md-11" style="background: #ffeec8a6; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">

                  @if ($post->tags->count() > 0)
                  <h3 style="padding-top: 20px" class="text-center"><i class="bi bi-tags"></i> Tags</h3>

                  <div style="
                        border: 2px solid;
                        border-radius: 15px;
                        border-color: #ffd66d;
                        background: #f6fdff;
                        margin-bottom: 40px;
                        box-shadow: inset 5px 11px 9px 3px rgb(197 202 205 / 84%);
                  ">

                        <div class="text-center" style="padding: 10px">

                              @foreach ($post->tags as $tag)
                              <button
                                    style="border-radius: 20px; margin: 5px;"
                                    class="btn btn-outline-warning slim-button"
                              >{{$tag->title}}</button>
                              @endforeach
                        </div>
                  </div>
                  @endif

                  @if (!empty($post->description))

                  <div class="gap-20"></div>
                  <h3 class="text-center"><i class="bi bi-card-text"></i> Descrição</h3>

                  <div class="text-center" style="
                        border: 2px solid;
                        border-radius: 15px;
                        border-color: #ffd66d;
                        background: #f6fdff;
                        margin-bottom: 30px;
                        box-shadow: inset 5px 11px 9px 3px rgb(197 202 205 / 84%);
                  ">

                        <div class="gap-20"></div>
                        <p style="font-size: 24px"> {{$post->description}} </p>
                  </div>
                  @endif
            </div>
      </div>

      <hr>
      <div class="gap-40"></div>
      {{-- <div class="gap-40"></div>--}}




      <div style="justify-content: center;" class="form-group row">
            <div class="col-md-11" style="background: #ffeec8a6; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">

                  <div class="gap-20"></div>
                  <h3 class="text-center"><i class="bi bi-basket"></i> Ingredientes</h3>

                  <div id="ingredients">
                        @foreach ($ingredients as $ingredient)

                        <div class="ingredient-stage" id="ingredient-stage-1" style="
                              border: 2px solid;
                              border-radius: 15px;
                              border-color: #ffd66d;
                              background: #f6fdff;
                              margin-bottom: 40px;
                              box-shadow: inset 5px 11px 9px 3px rgb(197 202 205 / 84%);
                        ">
                              <div style="
                                    padding: 0px;
                                    border-bottom: 4px solid;
                                    border-color: #ffd66d;
                                    display:grid;
                                    place-items:center;
                                    overflow:hidden
                              ">
                              <h2>{{$ingredient->title}}</h2>
                              </div>

                              <div class="gap-40"></div>

                              <div style="justify-content: center" class="row" >

                                    <ul class="col-md-10" id="ingredient-1-steps">
                                          @foreach ($ingredient->steps as $step)

                                          <li style="margin-bottom: 10px;  font-size: 20px" class="ingredient-1-step" id="ingredient-1-step-98">
                                                <div class="row">
                                                      <p style="margin-left: 20px; font-size: 30px">{{$step->content}} </p>
                                                </div>
                                          </li>
                                          @endforeach
                                    </ul>
                              </div>

                              <div class="gap-20" style="border-top: 2px solid; border-color: #ffd66d;"></div>
                        </div>
                        @endforeach
                  </div>

                  <div class="gap-40"></div>
            </div>
      </div>

      <div class="gap-40"></div>








      <div style="justify-content: center;" class="form-group row">
            <div class="col-md-11" style="background: #ffeec8a6; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">

                  <div class="gap-20"></div>
                  <h3 class="text-center"><i class="bi bi-hammer"></i> Modo de Preparo</h3>

                  <div id="preparations">
                        @foreach ($preparations as $preparation)

                        <div class="preparation-stage" id="preparation-stage-1" style="
                              border: 2px solid;
                              border-radius: 15px;
                              border-color: #ffd66d;
                              background: #f6fdff;
                              margin-bottom: 40px;
                              box-shadow: inset 5px 11px 9px 3px rgb(197 202 205 / 84%);
                        ">
                              <div style="
                                    padding: 0px;
                                    border-bottom: 4px solid;
                                    border-color: #ffd66d;
                                    display:grid;
                                    place-items:center;
                                    overflow:hidden
                              ">
                              <h2>{{$preparation->title}}</h2>
                              </div>

                              <div class="gap-40"></div>
                              <div style="justify-content: center" class="row" >

                                    <ol class="col-md-10" id="preparation-1-steps">
                                          @foreach ($preparation->steps as $step)

                                          <li style="margin-bottom: 10px; font-size: 30px" class="preparation-1-step" id="preparation-1-step-98">
                                                <div class="row">
                                                      <p style="margin-left: 20px; font-size: 30px">{{$step->content}} </p>
                                                </div>
                                          </li>
                                          @endforeach
                                    </ol>

                              </div>
                              <div class="gap-20" style="border-top: 2px solid; border-color: #ffd66d;"></div>
                        </div>

                        @endforeach
                  </div>

                  <div class="gap-40"></div>
            </div>
      </div>


      {{-- ------------------------------------------------------------------------------------------------------ --}}
      {{-- ------------------------------------------------------------------------------------------------------ --}}


      <div class="gap-20"></div>
      <hr>
      <div class="gap-20"></div>



      {{-- ------------------------------------------------------------------------------------------------------ --}}
      {{-- ------------------------------------------------------------------------------------------------------ --}}



      <div style="justify-content: center" class="row">
            <div class="simple-card col-md-11">
                  <div class="gap-40"></div>
                  <h3 class="text-center"><i class="bi bi-chat-square-text"></i> Comentários</h3>
                  <div class="gap-40"></div>
                  <div class="row" style="justify-content: center">
                        <div  class="col-md-11">
                              <div class="row">
                                    <div class="col-md-3">

                                          <label style="margin-left: 20px; font-weight:bold">Escreva um Comentário</label>
                                    </div>
                                    <div class="col-md-7"></div>
                                    <div class="col-md-2">
                                          <button onclick="Comment()" class="slim-button btn btn-primary">Enviar</button>
                                    </div>
                              </div>
                              <textarea id="comment-content"
                                    style="font-size: 20px" rows="4"
                                    class="form-control"
                                    placeholder="Deixe sua opnião sobre a Receita..."
                              ></textarea>
                        </div>
                  </div>
                  <div class="gap-20"></div>
                  <hr style="background: rgb(63, 63, 63)">
                  <div class="gap-40"></div>
                  <div class="row" style="justify-content: center">
                        <div id="comments" class="col-md-11">

                              @foreach ($post->comments->sortByDesc('created_at') as $comment)

                              <div id="comment-{{$comment->id}}">
                                    <div style="margin-right: 19px" class="text-right">

                                          <a href="{{route('profile-show', $comment->user->slug)}}"
                                                style="color: #ffb600; font-size:19px"
                                          >
                                                {{$comment->user->name}} @if($comment->user->id == $post->user->id)
                                                <i class="bi bi-award-fill"></i>@endif
                                          </a>
                                    </div>
                                    <div class="simple-container">
                                          <div class="gap-20 text-right">

                                                @if ($comment->user->id == Auth::id())
                                                <a href="#comment-{{$comment->id}}"
                                                      class="close" data-dismiss="alert"
                                                      aria-label="close" id="hide"
                                                      style="
                                                            margin-left: 40px;
                                                            font-size: 30px;
                                                            position: absolute;
                                                            right: 2.7%;
                                                      "
                                                      onclick="RemoveComment({{$comment->id}})"
                                                >&times;</a>
                                                @endif
                                          </div>
                                          <h4 class="text-center">{{$comment->content}}</h4>
                                    </div>

                                    <hr style="background: #ffd66d">
                              </div>
                              @endforeach
                        </div>
                  </div>
            </div>
      </div>

      </div>

</div><!-- Content row -->

@endsection



@section('scripts')
      <script src="{{asset('constra/js/postScripts.js')}}"></script>

      <script>

            var c1 = 0
            var v1
            function Favorite(value)
            {

                  if(c1 > 0){
                        value = !v1
                        v1 = !v1
                  }
                  else
                        v1 = value

                  $('#favorite-btn').text(!value?'Marcar Favorito':'Retirar Favorito')

                  axios.post('{{route('favorite')}}', {

                        'user_id' : {{Auth::id()}},
                        'post_id' : {{$post->id}}
                  }).then((response) => {

                        console.log(response.data)
                  }).catch(function (error) {
                        console.log(error);
                  })
                  c1 ++
            }

            function Like()
            {

                  let dBtn_i = $('#dislike-btn').children()
                  let lBtn_i = $('#like-btn').children()
                  let remove = lBtn_i.attr('class').includes("fill")

//                HERE I SWITCH THE BUTTON ICONS
                  lBtn_i.toggleClass('bi-hand-thumbs-up')
                  lBtn_i.toggleClass('bi-hand-thumbs-up-fill')
                  if(dBtn_i.attr('class').includes("fill")){

                        dBtn_i.toggleClass('bi-hand-thumbs-down')
                        dBtn_i.toggleClass('bi-hand-thumbs-down-fill')
                  }


                  axios.post('{{route('like')}}', {

                        'user_id' : {{Auth::id()}},
                        'post_id' : {{$post->id}},
                        'value' : true,
                        'remove' : remove ,
                  }).then((response) => {

                        console.log(response.data)
                  }).catch(function (error) {
                        console.log(error);
                  })
            }

            function Dislike()
            {
                  let lBtn_i = $('#like-btn').children()
                  let dBtn_i = $('#dislike-btn').children()
                  let remove = dBtn_i.attr('class').includes("fill")

//                HERE I SWITCH THE BUTTON ICONS
                  dBtn_i.toggleClass('bi-hand-thumbs-down')
                  dBtn_i.toggleClass('bi-hand-thumbs-down-fill')
                  if(lBtn_i.attr('class').includes("fill")){

                        lBtn_i.toggleClass('bi-hand-thumbs-up')
                        lBtn_i.toggleClass('bi-hand-thumbs-up-fill')
                  }


                  axios.post('{{route('like')}}', {

                        'user_id' : {{Auth::id()}},
                        'post_id' : {{$post->id}},
                        'value' : false,
                        'remove' : remove ,
                  }).then((response) => {

                        console.log(response.data)
                  }).catch(function (error) {
                        console.log(error);
                  })
            }

            function Comment()
            {

                  let content = $('#comment-content').val()

                  if(content) axios.post('{{route('comment')}}', {

                        'user_id' : {{Auth::id()}},
                        'post_id' : {{$post->id}},
                        'content' : content
                  }).then((response) => {

                        console.log(response.data)
                        $('#comment-content').val('')
                        AddComment(response.data.comment_id, response.data.content)
                  }).catch(function (error) {
                        console.log(error);
                  })
            }

            function AddComment(id, content)
            {

                  $('#comments').prepend(`
                        <div id="comment-${id}">
                              <div style="margin-right: 19px" class="text-right">

                                    <a href="{{route('profile-show', Auth::user()->slug)}}"
                                          style="color: #ffb600; font-size:19px"
                                    >
                                          {{Auth::user()->name}} @if(Auth::id() == $post->user->id)
                                          <i class="bi bi-award-fill"></i>@endif
                                    </a>
                              </div>
                              <div class="simple-container">
                                    <div class="gap-20 text-right">


                                          <a href="#comment-${id}"
                                                class="close" data-dismiss="alert"
                                                aria-label="close" id="hide"
                                                style="
                                                      margin-left: 40px;
                                                      font-size: 30px;
                                                      position: absolute;
                                                      right: 2.7%;
                                                "
                                                onclick="RemoveComment(${id})"
                                          >&times;</a>

                                    </div>
                                    <h4 class="text-center">${content}</h4>
                              </div>

                              <hr style="background: #ffd66d">
                        </div>
                  `)
            }

            function RemoveComment(id)
            {

                  axios.post('{{route('comment-remove')}}', {

                        'user_id' : {{Auth::id()}},
                        'comment_id' : id
                  }).then((response) => {

                        console.log(response.data)
                  }).catch(function (error) {
                        console.log(error);
                  })
            }
      </script>
@endsection
