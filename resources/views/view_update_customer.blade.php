@extends('layouts.app')
@section('content')
    <script>
        function validate_form() {
            if (document.getElementById('customer_name').value == "") {
                $("#span_customer_name").html("Empty").show().fadeOut("slow");
                return false;
            }
            return true;
        }
    </script>

    @if (isset($customer_collection) && !empty($customer_collection))
        @foreach ($customer_collection as $array_collection)
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Update Customer</div>
                            @include('input_box_error_message')
                            @include('flash_message')
                            <div class="panel-body">
                                <form class="form-horizontal" onsubmit="return validate_form()" method="POST"
                                    action="{{ action('Controller_Customer@fun_update_customer', $array_collection->{CUSTOMER_INR_ID}) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Customer Name</label>
                                        <div class="col-md-6">
                                            <input id="{{ CUSTOMER_NAME }}" type="text" maxlength="50"
                                                onkeyup="this.value = this.value.toUpperCase();" class="form-control"
                                                name="{{ CUSTOMER_NAME }}" value="{{ $array_collection->{CUSTOMER_NAME} }}"
                                                autofocus required>
                                            <span id="span_customer_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Address</label>
                                        <div class="col-md-6">
                                            <input id="{{ CUSTOMER_ADDRESS }}" type="text" maxlength="255"
                                                class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                                                name="{{ CUSTOMER_ADDRESS }}"
                                                value="{{ $array_collection->{CUSTOMER_ADDRESS} }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">MOBILE</label>
                                        <div class="col-md-6">
                                            <input id="{{ MOBILE }}" type="number" class="form-control"
                                                maxlength="10" name="{{ MOBILE }}"
                                                value="{{ $array_collection->{MOBILE} }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">GST</label>
                                        <div class="col-md-6">
                                            <input id="{{ CUSTOMER_GST }}" type="text"
                                                onkeyup="this.value = this.value.toUpperCase();" class="form-control"
                                                maxlength="50" name="{{ CUSTOMER_GST }}"
                                                value="{{ $array_collection->{CUSTOMER_GST} }}" required
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Click to Update
                                            </button>
                                            <a href="/" role="button" class="btn btn-primary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
