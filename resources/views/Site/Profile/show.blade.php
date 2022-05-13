
@extends('Layouts.modelo2')

@section('content')


{{-- <div class="row"> --}}

<div class="row">
      <div class="col-md-4">
            <h2 style="margin-bottom: 100px">foto</h2>
      </div>
      <div class="col-md-3">
            <p>10 seguidores</p>
            @auth
            @if ($user->followers->contains('id', Auth::id()))
            <button id="follow-btn" onclick="Follow(false)">Deixar de Seguir</button>
            @else
            <button id="follow-btn" onclick="Follow(true)">Seguir</button>
            @endif
            @endauth
      </div>
      <div class="col-md-3">
            <p>14 receitas</p>
      </div>
</div>
<div class="gap-20"></div>
<div >

      <h1> {{$user->name}} </h1>
</div>

@if($user->about)
<div>
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

      <div class="col-md-11" style="background: #ffeec8a6; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">

            <div class="gap-20"></div>
            <h3 class="text-center"><i class="bi bi-book-half"></i> Receitas Publicadas</h3>
            <div class="gap-40"></div>

            @foreach ($user->posts as $post)
                  <h2>{{$post->title}}</h2>
                  <br>
            @endforeach
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

            $('#follow-btn').text(!value?'Seguir':'Deixar de Seguir')

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