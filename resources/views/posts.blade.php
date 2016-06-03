@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @include('partials/errors')
                @include('partials/success')
                
                <div class="row">
                    <div class='col-md-9'>
                        <section class='posts'>

                            @foreach ($posts as $post)
                                <div class="post tipo-{{ $post->tipo->name }}"> 
                                    <h3>{{ $post->title }}</h3>
                                    {!! $post->description !!}

                                    <div class="data">
                                        <span class='pull-right'>Tipo Evento: {{ $post->tipo->name }}<br>Creado por: {{ $post->user->name }}</span>
                                    </div>
                                </div>
                            @endforeach

                            {{ $posts->render() }}
                        </section>  
                    </div>
                    
                    <div class="col-md-3">
                        <div class='form-group' >
                            <label for='slc_tipo'>Tipo de Post</label>
                            <select id='slc_tipo' class='form-control'>

                                <option value='0' selected>Seleccione</option>
                                @foreach ($tipos as $tipo)
                                    <option value='{{ $tipo->id }}'>{{ $tipo->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
