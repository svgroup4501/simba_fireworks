@extends('layouts.app')
@section('content')
    <script>
        function validate_form() {
            if (document.getElementById('amount').value == "") {
                $("#span_amount").html("Empty").show().fadeOut("slow");
                return false;
            }
            return true;
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Credit</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <form class="form-horizontal" onsubmit="return validate_form()" method="POST"
                            action="{{ 'store_credit' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Customer Name</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="customer_inr_id" id="customer_inr_id">
                                        @foreach ($customer_collection as $single_customer)
                                            <option value="{{ $single_customer->customer_inr_id }}">
                                                {{ $single_customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Amount</label>
                                <div class="col-md-6">
                                    <input id="{{ AMOUNT }}" type="number" class="form-control"
                                        name="{{ AMOUNT }}" value="{{ old(AMOUNT) }}" required autocomplete="off">
                                    <span id="span_amount"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Click to Add
                                    </button>
                                    <a href="/" role="button" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
