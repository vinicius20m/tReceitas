@extends('Layouts.modelo2')

@section('content')
<h1> Hello World </h1>
<h2>teste do teste</h2>

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

@foreach ($posts as $post)

<div class="row">

      <a href="{{route('post-show', $post->slug)}}">{{$post->title}}</a>
      <div class="gap-20"></div>
</div>

@endforeach
@endsection