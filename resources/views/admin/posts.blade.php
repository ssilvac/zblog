@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('partials/errors')
            @include('partials/success')
            
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Post</div>

                <div class="panel-body">

                    <table class='table'>

                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Acciones</th>
                        </tr>

                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    @can('update', $post)
                                        <a href="{{ url('edit-post', [$post->id] ) }}">Editar</a>
                                    @else
                                        <a href="#">Report</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </table>

                    {{ $posts->render() }}
                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
