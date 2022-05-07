@extends('Layouts.modelo2')

@section('content')
<h1> Hello World </h1>
<h2>teste do teste</h2>

@foreach ($posts as $post)

<div class="row">

      <a href="{{route('post-show', $post->slug)}}">{{$post->title}}</a>
      <div class="gap-20"></div>
</div>

@endforeach
@endsection