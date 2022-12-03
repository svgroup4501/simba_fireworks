<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Simba</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

</head>
<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .modal-backdrop.in {
        opacity: 0;
    }

    .modal-backdrop {
        z-index: -1;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}">Simba</a>
                    @auth
                        <div class="container">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="{{ action('Controller_Customer@fun_view_add_customer') }}">Customer</a>
                                    </li>
                                    <li><a href="{{ action('Controller_Company@fun_view_add_company') }}">Company</a>
                                    </li>
                                    <li><a href="{{ action('Controller_Product@fun_view_add_product') }}">Product</a></li>
                                    @php
                                        $customer_collection = DB::table('customer')
                                            ->select('customer_inr_id', 'customer_name')
                                            ->get();
                                        $company_collection = DB::table('company')
                                            ->select('company_inr_id', 'company_name')
                                            ->get();
                                    @endphp
                                    @if (!empty($customer_collection) && $customer_collection->count() && !empty($company_collection) && $company_collection->count() )
                                        <li>
                                            <a href="#select_customer_modal" data-toggle="modal">
                                                Particular
                                            </a>
                                            <!-- Select Customer Modal -->
                                            <div class="modal fade" id="select_customer_modal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Select Customer
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="form-horizontal" method="POST"
                                                            action="{{ action('Controller_Particular@fun_view_add_particular') }}">
                                                            <div class="modal-body">
                                                                {{ csrf_field() }}
                                                                <select class="form-control" id="customer_inr_id"
                                                                    name="customer_inr_id">
                                                                    @foreach ($customer_collection as $single_customer)
                                                                        <option
                                                                            value="{{ $single_customer->customer_inr_id }}">
                                                                            {{ $single_customer->customer_name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <div class="modal-footer">

                                                                <button type="submit" class="btn btn-primary">
                                                                    Click to Go
                                                                </button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Settings<span
                                                class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ action('Controller_Reset@fun_view_reset_year') }}">Reset
                                                    Year</a></li>
                                            <li><a href="{{ route('logout') }}">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

        </nav>
        @yield('content')
    </div>
</body>

</html>
