@extends('Layouts.modelo2')

@section('content')

<div class="gap-40"></div>

<div class="row">
      <div class="col-md-12">
      <div class="row">
            <h1 class="column-title col-md-4">{{$post->title}}</h1>
            <a class="col-md-1" style="margin-top: 17px; color: #ffb600"
                  href="{{
                        route('home')
                  }}"
            >Voltar</a>
      </div>

      <div >
            Por : &nbsp&nbsp <a href="" style="color: #ffb600">{{$post->user->name}}</a> &nbsp&nbsp&nbsp {{$post->created_at}}
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

                  <div class="row">
                        <h3 style="left: 43%; position: relative;">rende</h3>
                  </div>
                  <a href="" style="font-size: 34px; color:#ffb600; margin-left: 10px">{{$post->portions}} {{$post->portions > 1 ? 'Porções' : 'Porção'}}</a>
            </div>
      </div>

      {{-- ------------------------------------------------------------------------------------------------------ --}}


      <div class="gap-40"></div>
      <div class="gap-20"></div>

      {{-- ------------------------------------------------------------------------------------------------------ --}}


      <div style="justify-content: center;" class="form-group row">
            <div class="col-md-11" style="background: #ffeec8a6; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">

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
                                    style="border-radius: 20px; margin: 5px; padding-top:2px; padding-bottom:2px;"
                                    class="btn btn-outline-warning"
                              >{{$tag->title}}</button>
                              @endforeach
                        </div>
                  </div>

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

      <div class="gap-40"></div>
      <div class="gap-40"></div>




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

      <div class="text-right"><br>
            <a class="col-md-1" style="color: #ffb600"
                  href="{{
                        route('home')
                  }}"
            >Voltar</a>
      </div>
      </div>

</div><!-- Content row -->

@endsection



@section('scripts')
      <script src="{{asset('constra/js/postScripts.js')}}"></script>
@endsection
