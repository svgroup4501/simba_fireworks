@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">View Particular</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Sl.No</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>View</th>
                                <th>Print</th>
                            </tr>
                            @if (!empty($data) && $data->count())
                                @foreach ($data as $array_collection)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) }}</td>
                                        <td>{!! $array_collection->{CUSTOMER_NAME} !!}</td>
                                        <td>{!! $array_collection->{AMOUNT} !!}</td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="View">
                                                <a href="{{ action('Controller_Particular@fun_view_single_particular', [$array_collection->{PARTICULAR_INR_ID}]) }}"
                                                    class="btn btn-primary btn-sm" role="button" data-toggle="modal">
                                                    <span class="glyphicon glyphicon-eye-open"></span>
                                                </a>
                                            </p>
                                        </td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Print">
                                                <a href="{{ action('Controller_Print@fun_print_particular', [$array_collection->{PARTICULAR_INR_ID}]) }}"
                                                    class="btn btn-primary btn-sm" target="_blank" role="button"
                                                    data-toggle="modal">
                                                    <span class="glyphicon glyphicon-print"></span>
                                                </a>
                                            </p>

                                        </td>
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
