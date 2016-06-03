@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('partials/errors')
            @include('partials/success')


            <div class="panel panel-default">
                <div class="panel-heading">New post</div>

                <div class="panel-body">
                    
                    <form action="{{ url('publish') }}" role='form' method='POST'>

                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>


                        <div class="form-group">
                            <label for="title">Nombre</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nombre">
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
                            <label for="description">Texto</label>
                            <textarea class="form-control" rows="3" name='description' id='description'></textarea>     
                        </div>

                        <br>    

                        <button type="submit" class="btn btn-default">Submit</button>
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