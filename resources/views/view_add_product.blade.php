@extends('layouts.app')
@section('content')
    <script>
        function validate_form() {
            if (document.getElementById('product_name').value == "") {
                $("#span_product_name").html("Empty").show().fadeOut("slow");
                return false;
            }
            return true;
        }

        function validate_edit_form() {
            if (document.getElementById('product_name_modal').value == "") {
                $("#span_product_name_modal").html("Empty").show().fadeOut("slow");
                return false;
            }
            return true;
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Particular</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <form class="form-horizontal" onsubmit="return validate_form()" method="POST"
                            action="{{ 'store_product' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Particular Name</label>
                                <div class="col-md-6">
                                    <input id="{{ PRODUCT_NAME }}" type="text"
                                        onkeyup="this.value = this.value.toUpperCase();" maxlength="50" class="form-control"
                                        name="{{ PRODUCT_NAME }}" value="{{ old(PRODUCT_NAME) }}" required autofocus autocomplete="off">
                                    <span id="span_product_name"></span>
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
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">View Particular</div>
                    <table class="table" style="margin: 20px">
                        <tr>
                            <th>Sl.No</th>
                            <th>Particular Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @if (!empty($data) && $data->count())
                            @foreach ($data as $array_collection)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{!! $array_collection->{PRODUCT_NAME} !!}</td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <a href="#edit_particular_modal_{{ $array_collection->{PRODUCT_INR_ID} }}"
                                                class="btn btn-primary btn-sm" role="button" data-toggle="modal">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            </a>
                                        </p>
                                        <!-- Edit Particular Modal HTML -->
                                        <div id="edit_particular_modal_{{ $array_collection->{PRODUCT_INR_ID} }}"
                                            class="modal fade">
                                            <div class="modal-dialog modal-confirm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Paticular</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" onsubmit="return validate_edit_form()"
                                                            method="POST" action="{{ action('Controller_Product@fun_update_product') }}">
                                                            {{ csrf_field() }}

                                                            <label for="name" class="col-md-4 control-label">Particular
                                                                Name</label>
                                                            <div class="col-md-6">
                                                                <input id="{{ PRODUCT_NAME_MODAL }}" type="text"
                                                                    onkeyup="this.value = this.value.toUpperCase();"
                                                                    maxlength="50" class="form-control"
                                                                    name="{{ PRODUCT_NAME_MODAL }}"
                                                                    value="{{ $array_collection->{PRODUCT_NAME} }}"
                                                                    required autofocus>
                                                                <span id="span_product_name_modal"></span>
                                                                <input id="{{ PRODUCT_INR_ID_MODAL }}" type="hidden"
                                                                    class="form-control" name="{{ PRODUCT_INR_ID_MODAL }}"
                                                                    value="{{ $array_collection->{PRODUCT_INR_ID} }}"
                                                                    required>
                                                            </div>
                                                            <button type="submit"
                                                                style="margin-left: 204px;margin-top:10px"
                                                                class="btn btn-primary">
                                                                Click to Update
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <a href="#delete_particular_modal_{{ $array_collection->{PRODUCT_INR_ID} }}"
                                                class="btn btn-danger btn-sm" role="button" data-toggle="modal">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </a>
                                        </p>
                                        <!-- Delete Particular Modal HTML -->
                                        <div id="delete_particular_modal_{{ $array_collection->{PRODUCT_INR_ID} }}"
                                            class="modal fade">
                                            <div class="modal-dialog modal-confirm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Paticular -
                                                            {{ $array_collection->{PRODUCT_NAME} }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this record ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ action('Controller_Product@fun_delete_product', [$array_collection->{PRODUCT_INR_ID}]) }}"
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
@endsection
