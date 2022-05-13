
@extends('Layouts.modelo2')

@section('content')
      

<div class="row">

      <form action="{{route('teste')}}" method="POST" enctype="multipart/form-data">
      
            @csrf
            <div class="form-group">
                  <label style="padding-bottom: 10px;">Foto
                  <input name="image" type="file" class="form-control-file"></label>
            </div>
            <div class="form-group">
                  <button type="submit">Enviar</button>
            </div>
      </form>
      <img src="" alt="">
</div>

@endsection