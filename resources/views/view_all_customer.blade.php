@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">View Customer</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Sl.No</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Mobile</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @if (!empty($data) && $data->count())
                                @foreach ($data as $array_collection)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{!! $array_collection->{CUSTOMER_NAME} !!}</td>
                                        <td>{!! $array_collection->{CUSTOMER_ADDRESS} !!}</td>
                                        <td>{!! $array_collection->{MOBILE} !!}</td>
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
                                                    <span class="glyphicon glyphicon-print"></span>
                                                </a>
                                            </p>
                                        </td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                <a href="#delete_customer_modal_{{ $array_collection->{CUSTOMER_INR_ID} }}"
                                                    class="btn btn-danger btn-sm" role="button" data-toggle="modal">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </p>
                                        </td>
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
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
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
