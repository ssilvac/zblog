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
                                <div class="col-md-6">
                                    <div class="post tipo-{{ $post->tipo->name }}">
                                        <img class='img_post' src="{{ $post->imagen }}" alt="{{ $post->name }}">
                                        <h3>{{ $post->title }}</h3>
                                        {!! $post->description !!}

                                        <div class="data">
                                            <span class='pull-right'>Tipo Evento: {{ $post->tipo->name }}<br>Creado por: {{ $post->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            
                           
                        </section> 
                        <div class="col-md-12">

                            {{ $posts->render() }}
                        </div> 
                    </div>
                    
                    <div class="col-md-3">

                        <form action="{{ url('posts') }}" role='form' method='GET'>

                            <!-- <input type='hidden' name='_token' value='{{ csrf_token() }}'> -->

                            <div class='form-group' >
                                <label for='slc_tipo'>Tipo de Post</label>
                                <select id='slc_tipo' name='slc_tipo' class='form-control'>

                                    <option value='' selected>Seleccione</option>
                                    @foreach ($tipos as $tipo)
                                        <option value='{{ $tipo->id }}'>{{ $tipo->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <button class='btn btn-default'>Filtrar</button>
                            </div>

                        </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
