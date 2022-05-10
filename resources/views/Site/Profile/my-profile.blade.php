
@extends('Layouts.modelo2')

@section('content')


<div style="justify-content:right;" class="form-group row">
      <div class="col-md-9" style="background: #ffeec8a6; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">

            <div class="gap-20"></div>
            <h1 style="font-size: 50px" class="text-center"><i class="bi bi-person-workspace"></i> Meu Perfil</h1>

      </div>
</div>
<div class="gap-40"></div>
<div class="row">
      <div class="col-md-2"
            style="background: #ffeec8a6; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);"
      >

            <div class="gap-40"></div>
            <ul class="profile-items" style="">
                  <li>
                        <a class="selected-item" href="{{route('profile-show', $user->slug)}}"><i class="bi bi-person-workspace"></i> Meu Perfil</a>
                  </li>

                  <li>
                        <a href="{{route('profile-posts')}}"><i class="bi bi-book-half"></i> Minhas Receitas</a>
                  </li>

                  <li>
                        <a href="{{route('profile-favorites')}}"><i class="bi bi-star-fill"></i> Favoritas</a>
                  </li>

                  <li>
                        <a href="{{route('profile-following')}}"><i class="bi bi-people-fill"></i> Seguindo</a>
                  </li>
            </ul>


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

            <form id="contact-form" action="{{ route('profile-update', $user->slug) }}" method="post" role="form">
                  @csrf
                  <div class="form-group row">

                        <div class="col-md-3">
                              <h1 style="margin-bottom: 100px">foto</h1>

                              <p>392 Seguidores</p>
                              <br>
                              <p>Seguindo 145</p>
                              <br>
                              <p>14 Receitas</p>
                        </div>

                        <div  class="col-md-9">
                              <div class="form-group">
                                    <label>Nome <span style="@error('name') color: red @enderror">*</span> </label>
                                    <input id="name" name="name"
                                          class="form-control form-control-name @error('name') is-invalid @enderror"
                                          value="{{ old('name') ?? $user->name }}"
                                          type="text" autofocus required
                                    >
                                    @error('name')
                                          <div style="color: darkorange"> {{ $message }} </div>
                                    @enderror
                              </div>

                              <div class="form-group">

                                    <label>Email</label>
                                    <input class="form-control"
                                          type="text" disabled value="{{$user->email}}"
                                    >
                              </div>

                              <div class="gap-20"></div>
                              <div class="form-group">
                                    <label>Sobre Você</label>
                                    @error('about')
                                    <div style="color: darkorange"> {{ $message }} </div>
                                    @enderror
                                    <textarea class="form-control form-control-about @error('about') is-invalid @enderror"
                                          name="about" id="about" placeholder="Conte a todos um pouco sobre você"
                                          style="min-height: 70px" type="text"
                                    >{{ old('about') ?? $user->about }}</textarea>
                              </div>

                        </div>
                  </div>


                  <div class="text-right"><br>
                        <a class="col-md-1" style="color: #ffb600"
                              href="{{
                                    route('begin')
                              }}"
                        >Voltar</a>
                        <button class="btn btn-primary solid blank" type="submit">Salvar</button>
                  </div>
            </form>
      </div>

</div>

@endsection

@section('scripts')

@endsection