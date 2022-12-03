@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Menu</div>
                    @include('flash_message')
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Customer
                                    </a>
                                    <a href="{{ action('Controller_Customer@fun_view_add_customer') }}"
                                        class="list-group-item">Add Customer</a>
                                    <a href="{{ action('Controller_Customer@fun_view_all_customer') }}"
                                        class="list-group-item">View Customer</a>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Credit
                                    </a>
                                    <a href="{{ action('Controller_Credit@fun_view_add_credit') }}" class="list-group-item">Add
                                        Credit</a>
                                    <a href="{{ action('Controller_Reset@fun_view_reset_year') }}"
                                        class="list-group-item">Reset Year</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Particular
                                    </a>
                                    <a href="{{ action('Controller_Particular@fun_view_add_particular') }}"
                                        class="list-group-item">Add Particular</a>
                                    <a href="{{ action('Controller_Particular@fun_view_all_particular') }}"
                                        class="list-group-item">View Particular</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
