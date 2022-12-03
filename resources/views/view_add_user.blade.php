@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add User</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{'store_user'}}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">User Name</label>
                                <div class="col-md-6">
                                    <input id="{{ USERNAME }}" type="text"  maxlength="15" class="form-control" name="{{ USERNAME }}" value="{{ old( USERNAME ) }}"  autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="{{ PASSWORD }}" type="password" maxlength="15" class="form-control" name="{{ PASSWORD }}" value="{{ old( PASSWORD ) }}"  >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Click to Add
                                    </button>
                                    <a  href="/" role="button" class="btn btn-primary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
