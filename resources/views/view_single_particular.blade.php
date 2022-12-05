@extends('layouts.app')
@section('content')
    @if (isset($particular_collection) && !empty($particular_collection))
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Particular Details</div>
                        @include('input_box_error_message')
                        @include('flash_message')
                        <div class="panel-body">
                            <form>
                                @foreach ($customer_collection as $array_collection)
                                    <div class="card" style="display: flex;">
                                        <ul class="list-group list-group-flush" style="width: 69rem;margin-right:10px">
                                            <li class="list-group-item"> Bill No : <b>{!! $array_collection->{BILL_NUMBER} !!}</b></li>
                                            <li class="list-group-item"> Customer Name : <b>{!! $array_collection->{CUSTOMER_NAME} !!}</b></li>
                                            <li class="list-group-item"> Company Name : <b>{!! $array_collection->{COMPANY_NAME} !!}</b></li>
                                            </li>
                                            <li class="list-group-item"> Transport Name : <b>{!! $array_collection->{TRANSPORT_NAME} !!}</b>
                                            </li>
                                            </li>
                                            <li class="list-group-item"> Date : <b>{!! date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) !!}</b></li>
                                            <li class="list-group-item"> Total No.of Cases :
                                                <b>{!! $array_collection->{CASE_COUNT} !!}</b></b>
                                            </li>
                                            </li>
                                        </ul>
                                        <ul class="list-group list-group-flush" style="width: 69rem;">
                                            <li class="list-group-item"> Particular Amount : <b>{!! $array_collection->{PARTICULAR_AMOUNT} !!}</b>
                                            </li>
                                            <li class="list-group-item"> Discount Amount (<b>{!! $array_collection->{DISCOUNT_IN_PERCENTAGE} !!}%) : </b>{!! $array_collection->{DISCOUNT_AMOUNT} !!}</li>
                                            <li class="list-group-item"> Packing Amount (<b>{!! $array_collection->{PACKING_AMOUNT} !!}%) : </b>{!! $array_collection->{PACKING_PERCENTAGE} !!}</li>
                                            <li class="list-group-item"> Tax Amount : <b>{!! $array_collection->{TAX_AMOUNT} !!}</b></li>
                                            </li>
                                            <li class="list-group-item"> Bill Amount : <b>{!! $array_collection->{AMOUNT} !!}</b></li>
                                        </ul>
                                    </div>
                                @endforeach
                            </form>
                            <table class="table table-bordered" id="item_table">
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Particular Name</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Pkt / Unit</th>
                                    <th>Amount</th>
                                </tr>
                                @foreach ($particular_collection as $array_collection)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{!! $array_collection->{PRODUCT_NAME} !!}</td>
                                        <td>{!! $array_collection->{QUANTITY} !!}</td>
                                        <td>{!! $array_collection->{RATE} !!}</td>
                                        <td>{!! $array_collection->{PKT} !!}</td>
                                        <td>{!! $array_collection->{AMOUNT} !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @foreach ($customer_collection as $array_collection)
                                <div class="form-group ">
                                    <div class="col-md-12">
                                        @if (isset($array_collection->{BILL_NAME}) && !empty($array_collection->{BILL_NAME}))
                                            <img src="<?php echo Storage::url('app/receipt/') . $array_collection->{BILL_NAME}; ?>" style="width:300px;heigth:300px"
                                                alt="Receipt" />
                                        @endif
                                        <a href="{{ action('Controller_Particular@fun_view_add_particular_with_parameter', [$array_collection->{CUSTOMER_INR_ID}]) }}"
                                            style="float: right;margin-top: 10px" role="button"
                                            class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
