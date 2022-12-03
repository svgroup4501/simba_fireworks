@extends('layouts.app')
@section('content')
    <script>
        function validate_form() {
            if (document.getElementById('company_name').value == "") {
                $("#span_company_name").html("Empty").show().fadeOut("slow");
                return false;
            }
            if (document.getElementById('company_address').value == "") {
                $("#span_company_address").html("Empty").show().fadeOut("slow");
                return false;
            }
            if (document.getElementById('company_gst').value == "") {
                $("#span_company_gst").html("Empty").show().fadeOut("slow");
                return false;
            }
            return true;
        }
    </script>

    @if (isset($company_collection) && !empty($company_collection))
        @foreach ($company_collection as $array_collection)
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Update Company</div>
                            @include('input_box_error_message')
                            @include('flash_message')
                            <div class="panel-body">
                                <form class="form-horizontal" onsubmit="return validate_form()" method="POST"
                                    action="{{ action('Controller_Company@fun_update_company', $array_collection->{COMPANY_INR_ID}) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Name</label>
                                        <div class="col-md-6">
                                            <input id="{{ COMPANY_NAME }}" type="text" maxlength="50"
                                                onkeyup="this.value = this.value.toUpperCase();" class="form-control"
                                                name="{{ COMPANY_NAME }}" value="{{ $array_collection->{COMPANY_NAME} }}"
                                                autofocus required>
                                            <span id="span_company_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Address</label>
                                        <div class="col-md-6">
                                            <input id="{{ COMPANY_ADDRESS }}" type="text" maxlength="255"
                                                class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                                                name="{{ COMPANY_ADDRESS }}"
                                                value="{{ $array_collection->{COMPANY_ADDRESS} }}" required>
                                            <span id="span_company_address"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">GST</label>
                                        <div class="col-md-6">
                                            <input id="{{ COMPANY_GST }}" type="text"
                                                onkeyup="this.value = this.value.toUpperCase();" class="form-control"
                                                maxlength="10" name="{{ COMPANY_GST }}"
                                                value="{{ $array_collection->{COMPANY_GST} }}" required>
                                            <span id="span_company_gst"></span>
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
