@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            

            <div class="panel panel-default">
                <div class="panel-heading">Nueva publicación</div>

                <div class="panel-body">

                        @include('partials/errors')
                        @include('partials/success')
                    
                    <form action="{{ url('publish') }}" role='form' method='POST'  accept-charset="UTF-8" enctype="multipart/form-data">

                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>


                        <div class="form-group">
                            <label for="title">Nombre</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nombre" value="{{ old('title') }}">
                        </div>

                        <div class='form-group' >
                            <label for='tipo_id'>Tipo de Post</label>
                            <select id='tipo_id' name='tipo_id' class='form-control'>

                                <option value='0' selected>Seleccione</option>

                                @foreach ($tipos as $tipo)
                                    <option value='{{ $tipo->id }}'>{{ $tipo->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen principal</label>
                            <input type="file" class="form-control" name='imagen' id='imagen' value="{{ old('imagen') }}">
                        </div>

                        <div class="form-group">
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Texto</label>
                            <textarea class="form-control" rows="3" name='description' id='description'>{{ old('description') }}</textarea>     
                        </div>

                        <br>    

                        <button type="submit" class="btn btn-default">Publicar</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('libjs')
    <script src="/assets/js/tinymce/tinymce.min.js"></script>
    <script src="/assets/js/editor.js"></script>
@endsection