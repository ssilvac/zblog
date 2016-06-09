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

                    <form action="{{ url('admin/posts') }}" role='form' method='GET'>
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

                    <table class='table'>

                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Tipo</th>
                            <th>Creación</th>
                            <th>Acciones</th>
                        </tr>

                        @foreach ($posts as $post)
                            <tr id='tr_{{ $post->id }}'>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->tipo->name }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    @can('update', $post)
                                        <form   action="{{ url('admin/posts/delete', [$post->id] ) }}" method='POST' id='delete_post_{{ $post->id }}'>
                                                <?php echo method_field('DELETE'); ?>
                                                <input type="hidden" name="_token" class='token' value="{{ csrf_token() }}">
                                        </form>

                                        <a href="{!! route('admin.posts.edit', [$post->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="" data-post='{{ $post->id }}' class='btn-delete' "><i class="glyphicon glyphicon-remove"></i></a>
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

@section('libjs')
    <script src="/assets/js/admin/post.js"></script>
@endsection
