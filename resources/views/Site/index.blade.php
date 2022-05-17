@extends('Layouts.modelo2')

@section('content')

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

<div class="col-md-12 text-center">
</div>

<div class="col-md-3 text-center">
      <i style="font-size: 80px; margin-right: 100px" class="bi bi-book-half"></i>
</div>
<div class="col-md-8 text-center">
      <h2>{{$mainTitle}}</h2>
      <div class="gap-20"></div>
      <div class="row" style="display: flex; justify-content: center">

      <div class="simple-card search-div">
            <form action="/" method="GET">
                  <div class="search-box">
                        <button class="btn" type="submit"> <i class="bi bi-search"></i> </button>
                        <input name="search" placeholder="Pesquise..." type="text">
                  </div>
            </form>
      </div>
      </div>
</div>
<div class="gap-40"></div>

<div class=" col-md-2">
      <div class="simple-card row" style="padding: 10px">

            <style>
                  ul.profile-items li a {
                        padding: 10px 0px 10px;
                  }
            </style>

            <div class="gap-20"></div>
            <h4 class="text-center">categorias</h4>

            <ul class="profile-items">
                  @foreach ($categories as $category)

                  <li>
                        <a href="/?filterC={{$category->slug}}"> {{$category->title}}</a>
                  </li>
                  @endforeach
            </ul>

            <div class="gap-40"></div>
            <h4 class="text-center">tags</h4>

            <ul class="profile-items">
                  @foreach ($tags as $tag)

                  <li>
                        <a href="/?filterT={{$tag->slug}}"> {{$tag->title}}</a>
                  </li>
                  @endforeach
            </ul>
      </div>
</div>
<div class="col-md-2"></div>

<div class="col-md-8">
      <div class="simple-card row " style="padding: 30px">

      @if($posts->count() < 1)
      <h3 class="text-center">Nenhuma receita disponivel</h3>
      @else

      <div class="accordion" id="accordion">

            @foreach ($posts as $post)

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
                              <style>
                                    p{
                                          margin: 0px;
                                    }
                              </style>
                              <p>Publicada Por : &nbsp&nbsp <a href="{{route('profile-show', $post->user->slug)}}" style="color: #ffb600">{{$post->user->name}}</a></p>
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
      <div>
            {{$posts->links()}}
      </div>
      @endif
      </div>
</div>

@endsection