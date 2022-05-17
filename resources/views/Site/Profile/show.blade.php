
@extends('Layouts.modelo2')

@section('content')


{{-- <div class="row"> --}}

<div class="row">
      <div class="col-md-3">
            {{-- <h2 style="margin-bottom: 100px">foto</h2> --}}
            @if($user->image)
            <img src="{{asset('images/users\\'.$user->image)}}" width="100%" height="100%"
                  style=" border: 2px solid #ffd66d; border-radius: 50%; max-height: 250px" alt="Sem Foto"
            >
            @else
            <img src="{{asset('images/users/semFoto.png')}}" width="100%" height="100%"
                  style=" border: 2px solid #ffd66d; border-radius: 50%;" alt="Sem Foto"
            >
            @endif
      </div>
      <div class="col-md-3 text-center">
            <h4>{{$user->followers->count()}} {{$user->followers->count()>1?'seguidores':'seguidor'}}</h4>
            @auth
            @if ($user->followers->contains('id', Auth::id()))
            <button class="btn btn-warning" id="follow-btn" onclick="Follow(false)"><i class="bi bi-people-fill">Deixar de Seguir</i></button>
            @else
            <button class="btn btn-outline-warning" id="follow-btn" onclick="Follow(true)"><i class="bi bi-people">Seguir</i></button>
            @endif
            @endauth
      </div>
      <div class="col-md-3">
            <h4 class="text-center">{{$user->posts->where('private', '=', 0)->count()}} {{$user->posts->where('private', '=', 0)->count()>1?'receitas':'receita'}}</h4>
      </div>
</div>
{{-- <div class="gap-20"></div> --}}
<div >

      <h1> {{$user->name}} </h1>
</div>

@if($user->about)
<div class="text-center">
      <h4>{{$user->about}}</h4>
</div>
@endif

<div class="gap-40"></div>

<div style="justify-content: center;" class="form-group row">

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

      <div class="col-md-11 simple-card" style="padding: 30px">

            <div class="gap-20"></div>
            @if ($user->posts->where('private', '=', 0)->count() > 0)
            <h3 class="text-center"><i class="bi bi-book-half"></i> receitas publicadas: {{$user->posts->where('private', '=', 0)->count()}}</h3>

            <div class="gap-20"></div>
            <div class="accordion" id="accordion">

                  @foreach ($user->posts->where('private', '=', 0)->sortByDesc('created_at') as $post)
      
                  <div style="border-radius: 10px;" class="accordion-item">
      
                        <div class="accordion-header row" id="heading_{{$post->id}}">
                              <div onclick="window.location='{{route('post-show', $post->slug)}}'" style="padding: 0px; margin-right: 10px; overflow: hidden; border: 2px solid #ffd66d; border-radius: 10px; box-shadow: inset 0px 0px 122px 33px rgba(0,0,0,0.78);" class="col-md-3 header-img">
                                    @if($post->image)
                                    <img src="{{asset('images/posts\\'. $post->image)}}" width="100%"
                                          style=" border: 2px solid #ffd66d; border-radius: 10px;" alt="Sem Foto"
                                    >
                                    @else
                                    <img src="{{asset('images/posts/semFoto.jpg')}}" width="100%"
                                          style=" border: 2px solid #ffd66d; border-radius: 10px;" alt="Sem Foto"
                                    >
                                    @endif
                              </div>
      
                              <button type="button" class="accordion-button collapsed col-md-9 row"
                                    data-bs-toggle="collapse" data-bs-target="#collapse_{{$post->id}}"
                                    aria-expanded="false" aria-controls="collapse_{{$post->id}}"
                                    style="padding-bottom: 0px; padding-left: 0px; border: 2px solid #c3a047; border-radius: 0px 10px 10px 0px;"
                              >
                              <div class="row">
                                    <div class="col-md-8">
      
                                          <p style="font-size: 25px; font-weight: 600; color:#ffb600">{{$post->title}}</p>
                                    </div>
                                    <div style="padding-right: 0px; padding-left: 35px" class="col-md-4 row">
                                          <div style="padding: 0px" class="col-md-6">
                                                <i class="bi bi-hand-thumbs-up"
                                                      style="color: #ffb600; font-size: 26px;"
                                                ></i>
                                                <span style="font-size: 20px; font-weight: 200;">&nbsp&nbsp{{$post->likes()->wherePivot('value', '=', 1)->count()}}</span>
                                          </div>
                                          <div style="padding: 0px" class="col-md-6">
                                                <i class="bi bi-hand-thumbs-down"
                                                      style="color: #ffb600; font-size: 26px;"
                                                ></i>
                                                <span style="font-size: 20px; font-weight: 200;">&nbsp&nbsp{{$post->likes()->wherePivot('value', '=', 0)->count()}}</span>
                                          </div>
                                    </div>
                              </div>
                              <div class="row">
                                    <div style="padding-right: 0px" class="col-md-3">
                                          <h4 style="margin: 0px" class="text-center">Rende: &nbsp&nbsp <span style="color:#ffb600">{{$post->portions}}</span></h4>
                                    </div>
                                    <div class="col-md-3 text-center">
                                          <h4 style="margin: 0px">categoria: </h4>
                                    </div>
                                    <div class="col-md-6">
                                          <span style="color:#ffb600; font-size: 20px; font-weight: 600">&nbsp&nbsp{{$post->category->title}}</span>
                                    </div>
                              </div>
                              </button>
                        </div>
                        <div id="collapse_{{$post->id}}" class="accordion-collapse collapse"
                              aria-labelledby="heading_{{$post->id}}" data-bs-parent="#accordion"
                        >
                              <div class="accordion-body">
                                    <h4 class="text-center">
                                          {{$post->description}}
                                    </h4>
                                    {{-- <div class="gap-20"></div> --}}
                                    <p style="margin: 0px">Publicada Por : &nbsp&nbsp <a href="{{route('profile-show', $post->user->slug)}}" style="color: #ffb600">{{$post->user->name}}</a></p>
                                    <h5 class="text-center">Tags: </h5>
                                    <div class="text-center">
                                          @foreach ($post->tags as $tag)
                                          <button
                                                style="border-radius: 20px; margin: 5px;"
                                                class="btn btn-outline-warning slim-button"
                                                onclick="window.location='{{route('begin', 'filterT='.$tag->slug)}}'"
                                          >{{$tag->title}}</button>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="gap-20"></div>
                  @endforeach
            </div>

            @else
            <h3 class="text-center">nenhuma receita por enquanto</h3>
            @endif
            <div class="gap-40"></div>
      </div>
</div>
{{-- </div> --}}

@endsection

@section('scripts')
<script>
      var c = 0
      var v
      function Follow(value)
      {

            if(c > 0){
                  value = !v
                  v = !v
            }
            else
                  v = value

            follBtn = $('#follow-btn')

            follBtn.children().text(!value?'Seguir':'Deixar de Seguir')
            follBtn.children().toggleClass('bi bi-people-fill')
            follBtn.children().toggleClass('bi bi-people')

            follBtn.toggleClass('btn btn-outline-warning')
            follBtn.toggleClass('btn btn-warning')

            axios.post('{{route('follow')}}', {

                  'my_id' : {{Auth::id()}},
                  'following_id' : {{$user->id}}
            }).then((response) => {

                  console.log(response.data)
            })
            .catch(function (error) {
                  console.log(error);
            })
            c ++
      }
</script>
@endsection