@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Editar post</div>

                <div class="panel-body">

                    @include('partials/errors')
                    @include('partials/success')

                    {!! Form::model($post, ['route' => ['admin.posts.update', $post->id], 'method' => 'patch']) !!}

                        {!! csrf_field() !!}

                        
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for='title'>Nombre</label>

                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $post->title ) }}">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class='form-group' >
                            <label for='tipo_id'>Tipo de Post</label>
                            <select id='tipo_id' name='tipo_id' class='form-control'>

                                <option value='0' >Seleccione</option>

                                @foreach ($tipos as $tipo)

                                    @if($tipo->id == $post->tipo_id)
                                        <option value='{{ $tipo->id }}' selected>{{ $tipo->name }}</option>
                                    @else
                                        <option value='{{ $tipo->id }}'>{{ $tipo->name }}</option>
                                    @endif

                                    
                                @endforeach
        
                            </select>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label" for="description">Descripción</label>


                            <textarea class="form-control" name="description" id='description'>{!! $post->description !!}</textarea>
                            
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary form-control">
                                    <i class="fa fa-btn fa-user"></i>Actualizar
                                </button>
                            </div>
                        </div>
                        
                    {!! Form::close() !!}
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
