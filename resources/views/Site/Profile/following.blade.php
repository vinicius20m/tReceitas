
@extends('Layouts.modelo2')

@section('content')


<div style="justify-content:right;" class="form-group row">
      <div class="col-md-9 simple-card">

            <div class="gap-20"></div>
            <h1 style="font-size: 50px" class="text-center"><i class="bi bi-person-workspace"></i> Meu Perfil</h1>

      </div>
</div>
<div class="gap-40"></div>
<div class="row">
      <div class="col-md-2 ">
            <div class="simple-card row">
                  <div class="gap-20"></div>
                  <ul class="profile-items" style="padding: 10px">
                        <li>
                              <a href="{{route('profile-show', $user->slug)}}"><i class="bi bi-person-workspace"></i> Meu Perfil</a>
                        </li>

                        <li>
                              <a href="{{route('profile-posts')}}"><i class="bi bi-book-half"></i> Minhas Receitas</a>
                        </li>

                        <li>
                              <a href="{{route('profile-favorites')}}"><i class="bi bi-star-fill"></i> Favoritas</a>
                        </li>

                        <li>
                              <a class="selected-item" href="{{route('profile-following')}}"><i class="bi bi-people-fill"></i> Seguindo</a>
                        </li>
                  </ul>

                  <div class="gap-20"></div>
            </div>

      </div>

      <div class="col-md-1">
      </div>

      <div class="col-md-9">

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

            <div class="simple-card">
                  <div class="gap-40"></div>
                  @if ($user->following->count() > 0)
                  <h3 class="text-center"><i class="bi bi-people-fill"></i> Seguindo: {{$user->following->count()}}</h3>
                  <div style="padding-left: 40px">

                        @foreach ($user->following as $following)

                        <div class="row">
                              <div class="col-md-2" style="padding: 0px; border: 2px solid #ffd66d; border-radius: 50%; overflow:hidden; max-height: 100px">
                                    @if($following->image)
                                    <img src="{{asset('images/users\\'.$following->image)}}" width="100%" height="100%"
                                          alt="Sem Foto"
                                    >
                                    @else
                                    <img src="{{asset('images/users/semFoto.png')}}" width="100%" height="100%"
                                          alt="Sem Foto"
                                    >
                                    @endif
                              </div>
                              <div class="col-md-10">

                                    <h1 onclick="window.location='{{route('profile-show', $following->slug)}}'" class="mt-4 simple-link">{{$following->name}}</h1>
                              </div>
                        </div>
                        <div class="gap-20"></div>
                        @endforeach
                  </div>
                  @else
                  <h3 class="text-center">você ainda não segue ninguem</h3>
                  @endif
                  <div class="gap-40"></div>
            </div>
      </div>

</div>

@endsection

@section('scripts')

@endsection