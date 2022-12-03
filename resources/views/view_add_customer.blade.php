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
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Customer</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <form class="form-horizontal" onsubmit="return validate_form()" method="POST"
                            action="{{ 'store_customer' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Customer Name</label>
                                <div class="col-md-6">
                                    <input id="{{ CUSTOMER_NAME }}" type="text"
                                        onkeyup="this.value = this.value.toUpperCase();" maxlength="50" class="form-control"
                                        name="{{ CUSTOMER_NAME }}" value="{{ old(CUSTOMER_NAME) }}" required autofocus
                                        autocomplete="off">
                                    <span id="span_customer_name"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <input id="{{ CUSTOMER_ADDRESS }}" type="text"
                                        onkeyup="this.value = this.value.toUpperCase();" maxlength="250"
                                        class="form-control" autocapitalize="word" name="{{ CUSTOMER_ADDRESS }}"
                                        value="{{ old(CUSTOMER_ADDRESS) }}" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Mobile</label>
                                <div class="col-md-6">
                                    <input id="{{ MOBILE }}" type="number" class="form-control" maxlength="10"
                                        name="{{ MOBILE }}" value="{{ old(MOBILE) }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">GST</label>
                                <div class="col-md-6">
                                    <input id="{{ CUSTOMER_GST }}" type="text"
                                        onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="50"
                                        name="{{ CUSTOMER_GST }}" value="{{ old(CUSTOMER_GST) }}" required
                                        autocomplete="off">
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">View Customer</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Sl.No</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Mobile</th>
                                <th>GST</th>
                                <th>Edit</th>
                                <th>Print</th>
                                <th>Delete</th>
                            </tr>
                            @if (!empty($data) && $data->count())
                                @foreach ($data as $array_collection)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{!! $array_collection->{CUSTOMER_NAME} !!}</td>
                                        <td>{!! $array_collection->{CUSTOMER_ADDRESS} !!}</td>
                                        <td>{!! $array_collection->{MOBILE} ? $array_collection->{MOBILE} : '------' !!}</td>
                                        <td>{!! $array_collection->{CUSTOMER_GST} !!}</td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                <a href="{{ action('Controller_Customer@fun_view_update_customer', [$array_collection->{CUSTOMER_INR_ID}]) }}"
                                                    class="btn btn-primary btn-sm" role="button">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                            </p>
                                        </td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Print">
                                                <a href="{{ action('Controller_Print@fun_print_account', [$array_collection->{CUSTOMER_INR_ID}]) }}"
                                                    class="btn btn-primary btn-sm" role="button" target="_blank">
                                                    <span class="glyphicon glyphicon-print "></span>
                                                </a>
                                            </p>
                                        </td>
                                        @php
                                            $is_customer_exists = DB::table('account')
                                                ->where('customer_inr_id', $array_collection->{CUSTOMER_INR_ID})
                                                ->first();
                                        @endphp
                                        @if ($is_customer_exists)
                                            <td>
                                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                    <a href="#delete_customer_modal_{{ $array_collection->{CUSTOMER_INR_ID} }}"
                                                        class="btn btn-danger btn-sm disabled" role="button"
                                                        data-toggle="modal">
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    </a>
                                                </p>
                                            </td>
                                        @else
                                            <td>
                                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                    <a href="#delete_customer_modal_{{ $array_collection->{CUSTOMER_INR_ID} }}"
                                                        class="btn btn-danger btn-sm" role="button" data-toggle="modal">
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    </a>
                                                </p>
                                            </td>
                                        @endif
                                        <!-- Delete Modal HTML -->
                                        <div id="delete_customer_modal_{{ $array_collection->{CUSTOMER_INR_ID} }}"
                                            class="modal fade">
                                            <div class="modal-dialog modal-confirm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Customer -
                                                            {{ $array_collection->{CUSTOMER_NAME} }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this record ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ action('Controller_Customer@fun_delete_customer', [$array_collection->{CUSTOMER_INR_ID}]) }}"
                                                            class="btn btn-success" role="button">
                                                            <span class="glyphicon glyphicon-ok-sign"></span> Yes
                                                        </a>
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">
                                                            <span class="glyphicon glyphicon-remove"></span> No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                        </table>
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
