@extends('Layouts.modelo2')

@section('content')
<div class="row col-md-12">
      <h1 class="col-md-10"> <strong> Lista de Categorias </strong> </h1>
      <button type="button" class="col-md-1 btn btn btn-outline-success" onclick="window.location='{{ route('category-create') }}'"> <strong> Novo +</strong></button>
</div>
<div class="gap-40"></div>

@if($errors->any())
      <div id="error-card" class="alert alert-danger">
            <a href="#error-card" class="close" data-dismiss="alert" aria-label="close" id="hide">&times;</a>
            <ul>
            @foreach($errors->all() as $error)

                  <li> {{ $error }} </li>
            @endforeach
            </ul>
      </div>
@elseif(session('success'))
      <div id="success-card" class="alert alert-success">
            <a href="#success-card" class="close" data-dismiss="alert" aria-label="close" id="hide">&times;</a>
            {{ session('message') }}
      </div>
@endif

@if ($categories->count() > 0)
<table class="table">
      <thead class="thead-light">
            <tr>
                  <th scope="col">Titulo</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Ações</th>

            </tr>
      </thead>

      <tbody>
            @foreach ($categories as $category)

            <tr>
                  <td>{{$category->title}}</td>
                  <td>{{$category->description}}</td>
                  <td>
                        <div class="btn-group">
                              <button id="edit-button_{{$category->id}}" type="button"
                                    class="btn btn-outline-primary"
                                    onclick="window.location='{{route('category-edit', $category->slug)}}'"
                              >
                                    <i class="bi bi-pencil-square"></i>
                              </button>
                              <button id="delete-button_{{$category->id}}" type="button"
                                    class="btn btn-outline-danger"
                                    data-toggle="modal" data-target="#deleteItemModal_{{$category->id}}"
                              >
                                    <i class="bi bi-trash3-fill"></i>
                              </button>
                        </div>
                  </td>
            </tr>

            <div class="modal fade" id="deleteItemModal_{{$category->id}}"
                  tabIndex="-1" role="dialog" aria-hidden="true"
            >
                  <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 600px">
                        <div class="modal-content">
                        <div style="background: #b54c4c" class="modal-header">
                              <h4 class="modal-title" id="modalLongTitle">Excluindo a Categoria: <strong>{{$category->title}}</strong></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">

                              <h2 class="text-center">Tem certeza que deseja excluir esta Categoria?</h2>
                              {{-- <p class="text-center">Para manter o Item no Histórico, marque-o como Feito</p> --}}
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                              <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-dismiss="modal"
                                    onclick="window.location='{{ route('category-destroy', $category->slug) }}'"
                              >Sim</button>
                        </div>
                        </div>
                  </div>
            </div>
            @endforeach
      </tbody>
</table>
@else
<h4 class="text-center"> Nenhuma Categoria por enquanto. Adicione uma nova <a href="{{route('category-create')}}" style="color: #ffb600">Aqui</a>. </h4>
@endif

@endsection