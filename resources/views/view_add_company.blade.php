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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Company</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <form class="form-horizontal" onsubmit="return validate_form()" method="POST"
                            action="{{ 'store_company' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">Name</label>
                                <div class="col-md-8">
                                    <input id="{{ COMPANY_NAME }}" type="text"
                                        onkeyup="this.value = this.value.toUpperCase();" maxlength="50" class="form-control"
                                        name="{{ COMPANY_NAME }}" value="{{ old(COMPANY_NAME) }}" required autofocus
                                        autocomplete="off">
                                    <span id="span_company_name"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">Address</label>
                                <div class="col-md-8">
                                    <input id="{{ COMPANY_ADDRESS }}" type="text"
                                        onkeyup="this.value = this.value.toUpperCase();" maxlength="250"
                                        class="form-control" autocapitalize="word" name="{{ COMPANY_ADDRESS }}"
                                        value="{{ old(COMPANY_ADDRESS) }}" required autocomplete="off">
                                    <span id="span_company_address"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">GST</label>
                                <div class="col-md-8">
                                    <input id="{{ COMPANY_GST }}" type="text"
                                        onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="50"
                                        name="{{ COMPANY_GST }}" value="{{ old(COMPANY_GST) }}" required
                                        autocomplete="off">
                                    <span id="span_company_gst"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
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
            <?php
            $company_collection = DB::table(TB_COMPANY)
                ->orderBy(COMPANY_INR_ID, ASCENDING)
                ->get();
            $customer_collection = DB::table(TB_CUSTOMER)
                ->orderBy(CUSTOMER_INR_ID, ASCENDING)
                ->get();
            ?>
            @if (!empty($company_collection) &&
                $company_collection->count() &&
                !empty($customer_collection) &&
                $customer_collection->count())
            @endif
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">View Report</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" target="_blank"
                            action="{{ 'print_account_with_company_customer_pdf' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Company Name</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="selected_company_inr_id"
                                        name="selected_company_inr_id">
                                        @foreach ($company_collection as $single_company)
                                            <option value="{{ $single_company->company_inr_id }}">
                                                {{ $single_company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Customer Name</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="selected_customer_inr_id"
                                        name="selected_customer_inr_id">
                                        @foreach ($customer_collection as $single_customer)
                                            <option value="{{ $single_customer->customer_inr_id }}">
                                                {{ $single_customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" name="submitbutton" value="view_report">
                                        View Report
                                    </button>
                                    <button type="submit" class="btn btn-primary" name="submitbutton"
                                        value="view_particular">
                                        View Details
                                    </button>
                                    <a href="/" role="button" class="btn btn-primary"
                                        style="margin-top:-60px;margin-left:215px">Back</a>
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
                    <div class="panel-heading">View Company</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Sl.No</th>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>GST</th>
                                <th>Edit</th>
                                <th>Print</th>
                                <th>Delete</th>
                            </tr>
                            @if (!empty($data) && $data->count())
                                @foreach ($data as $array_collection)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{!! $array_collection->{COMPANY_NAME} !!}</td>
                                        <td>{!! $array_collection->{COMPANY_ADDRESS} !!}</td>
                                        <td>{!! $array_collection->{COMPANY_GST} !!}</td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                <a href="{{ action('Controller_Company@fun_view_update_company', [$array_collection->{COMPANY_INR_ID}]) }}"
                                                    class="btn btn-primary btn-sm" role="button">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                            </p>
                                        </td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Print">
                                                <a href="{{ action('Controller_Print@fun_print_account_with_company', [$array_collection->{COMPANY_INR_ID}]) }}"
                                                    class="btn btn-primary btn-sm" role="button" target="_blank">
                                                    <span class="glyphicon glyphicon-print "></span>
                                                </a>
                                            </p>
                                        </td>
                                        @php
                                            $is_company_exists = DB::table('account')
                                                ->where('company_inr_id', $array_collection->{COMPANY_INR_ID})
                                                ->first();
                                        @endphp
                                        @if ($is_company_exists)
                                            <td>
                                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                    <a href="#delete_company_modal_{{ $array_collection->{COMPANY_INR_ID} }}"
                                                        class="btn btn-danger btn-sm disabled" role="button"
                                                        data-toggle="modal">
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    </a>
                                                </p>
                                            </td>
                                        @else
                                            <td>
                                                <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                    <a href="#delete_company_modal_{{ $array_collection->{COMPANY_INR_ID} }}"
                                                        class="btn btn-danger btn-sm" role="button" data-toggle="modal">
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    </a>
                                                </p>
                                            </td>
                                        @endif

                                        <!-- Delete Modal HTML -->
                                        <div id="delete_company_modal_{{ $array_collection->{COMPANY_INR_ID} }}"
                                            class="modal fade">
                                            <div class="modal-dialog modal-confirm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Company -
                                                            {{ $array_collection->{COMPANY_NAME} }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this record ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ action('Controller_Company@fun_delete_company', [$array_collection->{COMPANY_INR_ID}]) }}"
                                                            class="btn btn-success" role="button">
                                                            <span class="glyphicon glyphicon-ok-sign"></span>Yes
                                                        </a>
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">
                                                            <span class="glyphicon glyphicon-remove"></span>No
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
