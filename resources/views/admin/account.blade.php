@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            @include('partials/errors')
            @include('partials/success')

            <div class="panel panel-default">
                <div class="panel-heading">My Account</div>

                <div class="panel-body">
                    
                    <li><a href="{{ url('account/edit-profile') }}">Edit profile</a></li>
                    <li><a href="{{ url('account/password') }}">Change password</a></li>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
