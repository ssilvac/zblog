@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Change your password</div>

                <div class="panel-body">
                    <form method='POST' action="{{ url('account/password') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for='current_password'>Contraseña actual</label>
                            <input type="text" name="current_password" class='form-control'>
                        </div>
    
                        <div class="form-group">
                            <label for='password'>Nueva contraseña</label>
                            <input type="text" name="password" class='form-control'> 
                        </div>
                           
                        
                        <div class="form-group">
                            <label for='password_confirmation'>Confirmar contraseña</label>
                            <input type="text" name='password_confirmation' class='form-control'>
                        </div>
                        
                        
                        <button type='submit'>Change password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
