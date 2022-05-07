@extends('Layouts.modelo2')

@section('content')

<div class="gap-40"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <h1 class="column-title col-md-5">Editando Categoria</h1>
                <a class="col-md-1" href="{{route('category')}}" style="margin-top: 17px; color: #ffb600">Voltar</a>
            </div>

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

            <form id="contact-form" action="{{ route('category-update', $category->slug) }}" method="post" role="form">
                  @csrf
                <div class="error-container"></div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Titulo</label>
                            <input name="title" id="title"
                                required autofocus type="text"
                                class="form-control form-control-name @error('title') is-invalid @enderror"
                                placeholder="EX: Alimenticios"
                                value="{{ old('title') == '' ? $category->title : old('title') }}"
                            >
                            @error('title')
                                <div style="color: darkorange"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="gap-20"></div>

                <div class="form-group">
                    <label>Descrição</label>
                    @error('description')
                        <div style="color: darkorange"> {{ $message }} </div>
                    @enderror
                    <input name="description" id="description"
                        class="form-control form-control-description @error('description') is-invalid @enderror"
                        placeholder="EX: Comestiveis em geral"
                        value="{{old('description') == '' ? $category->description : old('description')}}"
                        style="min-height: 70px" type="text"
                    >
                </div>

                <div class="text-right"><br>
                    <a class="col-md-1" href="{{route('category')}}" style="color: #ffb600">Voltar</a>
                    <button class="btn btn-primary solid blank" type="submit">Editar</button>
                </div>
            </form>
        </div>

    </div><!-- Content row -->
</div><!-- Conatiner end -->

@endsection