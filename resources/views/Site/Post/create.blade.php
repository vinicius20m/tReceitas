@extends('Layouts.modelo2')

@section('content')

<div class="gap-40"></div>

<div class="row">
      <div class="col-md-12">
      <div class="row">
            <h1 class="column-title col-md-4">Nova Receita</h1>
            <a class="col-md-1" style="margin-top: 17px; color: #ffb600"
                  href="{{
                        route('begin')
                  }}"
            >Voltar</a>
      </div>

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

      {{-- CREATE FORM --}}
      <form id="contact-form" action="{{ route('post-store') }}" method="post" role="form" enctype="multipart/form-data">
            @csrf
            <div style="padding: 0px" class="form-group row">
                  <div  class="col-md-8">
                        <div class="form-group row">
                              <div class="col-md-6">

                                    <label>Titulo <span style="@error('title') color: red @enderror">*</span> </label>
                                    <input id="title" name="title"
                                          class="form-control form-control-title @error('title') is-invalid @enderror"
                                          value="{{ old('title') }}" placeholder="Titulo/Nome da Receita"
                                          type="text" autofocus required
                                    >
                                    @error('title')
                                          <div style="color: darkorange"> {{ $message }} </div>
                                    @enderror
                              </div>
                              <div class="col-md-6">
                                    <label>Foto</label>
                                    <div class="input-group">
                                          <input name="image" type="file" class="form-control-file">
                                    </div>
                              </div>
                        </div>

                        <div class="row form-group">
                              <div class="col-md-6">
                                    <label>Categoria <span style="@error('category_id') color: red @enderror">*</span></label>
                                    <select required name="category_id" id="category_id"
                                          class="form-control @error('category_id') is-invalid @enderror"
                                    >
                                          <option style="background: #8f7d53b8" value="" >Selecione</option>
                                          @foreach ($categories as $category)

                                          <option value="{{$category->id}}"
                                                @if(old('category_id') == $category->id) selected @endif
                                          >{{$category->title}}</option>
                                          @endforeach
                                    </select>
                                    @error('category_id')
                                          <div style="color: darkorange"> {{ $message }} </div>
                                    @enderror
                              </div>

                              <div class="col-md-3">
                                    <label>Porções</label>
                                    <input name="portions" class="form-control"
                                          type="number" value="{{old('portions')}}"
                                    >
                              </div>

                              <div class="col-md-3 text-center form-check">
                                    <label>Receita Privada?</label>
                                    <input name="private" class="form-check-input"
                                          style="margin-top: 35px; font-size: 40px"
                                          type="checkbox" value="1" id="private"
                                          @if(old('private')) checked @endif
                                    >
                              </div>
                        </div>

                        <div class="gap-20"></div>
                        <div class="form-group">
                              <label>Descrição</label>
                              @error('description')
                              <div style="color: darkorange"> {{ $message }} </div>
                              @enderror
                              <textarea class="form-control form-control-description @error('description') is-invalid @enderror"
                                    name="description" id="description" placeholder="Breve Descrição da Receita"
                                    style="min-height: 70px" type="text"
                              >{{ old('description') }}</textarea>
                        </div>

                  </div>
                  <div class="form-group col-md-4">
                        <label>Tags (CTRL + Click para escolher várias)</label>
                        <select style="min-height: 278px" class="form-control" name="tags[]" id="tags" multiple>
                              @foreach ($tags as $tag)

                              <option value="{{$tag->id}}">{{$tag->title}}</option>
                              @endforeach
                        </select>
                  </div>
            </div>

            <div class="gap-20"></div>

            {{-- --------------------------------------------------------------------------------------------------- --}}
            {{-- --------------------------------------------------------------------------------------------------- --}}


            <hr style="background: rgb(63, 63, 63)">
            <div class="gap-40"></div>
            {{-- <div class="gap-20"></div> --}}

            {{-- --------------------------------------------------------------------------------------------------- --}}
            {{-- --------------------------------------------------------------------------------------------------- --}}





            <div style="padding: 0px" class="form-group row">
                  <div class="col-md-9 simple-card">

                        <div class="gap-20"></div>
                        <h3 class="text-center"><i class="bi bi-basket"></i> Ingredientes</h3>

                        <div id="ingredients">
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
                                          <input name="ingredientTitle[1]" type="text"
                                                class="text-center form-control"
                                                style="
                                                      border-top-left-radius: 13px;
                                                      border-top-right-radius: 13px;
                                                      font-weight: bold;
                                                      font-size: 30px;
                                                      background: #fff9aba1
                                                "
                                                placeholder="Ex: Cobertura"
                                          >
                                          <a href="#ingredient-stage-1" class="close" data-dismiss="alert" aria-label="close"
                                                id="hide" style="position: absolute; left: 94%; font-size: 35px;"
                                          >&times;</a>
                                    </div>

                                    <div class="gap-40"></div>

                                    <ul id="ingredient-1-steps">
                                          <li style="margin-bottom: 10px" class="ingredient-1-step" id="ingredient-1-step-98">
                                                <div class="row">

                                                      <input name="ingredient-step[1][]"
                                                            type="text"
                                                            class="form-control col-md-11"
                                                            style="max-width: 600px; margin-left: 15px"
                                                      >
                                                      <a href="#ingredient-1-step-98" class="close col-md-1" data-dismiss="alert" aria-label="close"
                                                            id="hide" style="margin-left: 40px; margin-top: 10px"
                                                      >&times;</a>
                                                </div>
                                          </li>
                                    </ul>

                                    <button
                                          style="border-radius: 10px;
                                                margin-left: 10px;
                                                margin-bottom: 10px;
                                          "
                                          class="btn btn-outline-warning"
                                          onclick="AddIngredientStep(1)"
                                          type="button"
                                    >+</button>

                                    <div class="gap-20" style="border-top: 2px solid; border-color: #ffd66d;"></div>
                              </div>
                        </div>

                        <button
                              style="border-radius: 10px;
                                    position: relative;
                                    margin-top: 15px;
                                    left: 44%;
                                    min-width: 100px
                              "
                              class="btn btn-primary"
                              onclick="AddIngredient()"
                              type="button"
                        >+</button>

                        <div class="gap-40"></div>
                  </div>
                  <div class="col-md-3">

                  </div>
            </div>

            <div class="gap-40"></div>


            {{-- --------------------------------------------------------------------------------------------------- --}}
            {{-- --------------------------------------------------------------------------------------------------- --}}


            {{-- --------------------------------------------------------------------------------------------------- --}}
            {{-- --------------------------------------------------------------------------------------------------- --}}




            <div style="padding: 0px" class="form-group row">
                  <div class="col-md-9 simple-card">

                        <div class="gap-20"></div>
                        <h3 class="text-center"><i class="bi bi-hammer"></i> Modo de Preparo</h3>

                        <div id="preparations">
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
                                          <input name="preparationTitle[1]" type="text"
                                                class="text-center form-control"
                                                style="
                                                      border-top-left-radius: 13px;
                                                      border-top-right-radius: 13px;
                                                      font-weight: bold;
                                                      font-size: 30px;
                                                      background: #fff9aba1
                                                "
                                          >
                                          <a href="#preparation-stage-1" class="close" data-dismiss="alert" aria-label="close"
                                                id="hide" style="position: absolute; left: 94%; font-size: 35px;"
                                          >&times;</a>
                                    </div>
      
                                    <div class="gap-40"></div>
      
                                    <ol id="preparation-1-steps">
                                          <li style="margin-bottom: 10px" class="preparation-1-step" id="preparation-1-step-98">
                                                <div class="row">
      
                                                      <input name="preparation-step[1][]"
                                                            type="text"
                                                            class="form-control col-md-11"
                                                            style="max-width: 600px; margin-left: 15px"
                                                      >
                                                      <a href="#preparation-1-step-98" class="close col-md-1" data-dismiss="alert" aria-label="close"
                                                            id="hide" style="margin-left: 40px; margin-top: 10px"
                                                      >&times;</a>
                                                </div>
                                          </li>
                                    </ol>
      
                                    <button
                                          style="border-radius: 10px;
                                                margin-left: 10px;
                                                margin-bottom: 10px;
                                          "
                                          class="btn btn-outline-warning"
                                          onclick="AddPreparationStep(1)"
                                          type="button"
                                    >+</button>
      
                                    <div class="gap-20" style="border-top: 2px solid; border-color: #ffd66d;"></div>
                              </div>
                        </div>
      
                        <button
                              style="border-radius: 10px;
                                    position: relative;
                                    margin-top: 15px;
                                    left: 44%;
                                    min-width: 100px
                              "
                              class="btn btn-primary"
                              onclick="AddPreparation()"
                              type="button"
                        >+</button>

                        <div class="gap-40"></div>
                  </div>
                  <div class="col-md-3">

                  </div>
            </div>

            <div class="text-right"><br>
                  <a class="col-md-1" style="color: #ffb600"
                        href="{{
                              route('begin')
                        }}"
                  >Voltar</a>
                  <button class="btn btn-primary solid blank" type="submit">Criar</button>
            </div>
      </form>
      </div>

</div><!-- Content row -->

@endsection



@section('scripts')
      <script src="{{asset('constra/js/postScripts.js')}}"></script>
@endsection
