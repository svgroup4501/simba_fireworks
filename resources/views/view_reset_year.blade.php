@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Year</div>
                    @include('input_box_error_message')
                    @include('flash_message')
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ 'store_reset_year' }}">
                            {{ csrf_field() }}
                            <div class="center_form">
                                <p><b>This option will reset the system to New Year Billing.</b></p>
                                <ul>
                                    <li>It will delete the list of Customers you entered.</li>
                                    <li>It will delete the list of Companies you entered.</li>
                                    <li>It will delete the list of Particulars you entered.</li>
                                    <li>It will delete the list of Accounts you entered.</li>
                                </ul>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <a href="#reset_year_modal" id={{ TAG_SUBMIT_BUTTON }} data-toggle="modal"
                                            role="button" class="btn btn-primary">
                                            Click To Reset Year
                                        </a>
                                        <a href="/" role="button" class="btn btn-primary">Back</a>
                                    </div>

                                    <!-- Reset Modal HTML -->
                                    <div id="reset_year_modal" class="modal fade">
                                        <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Reset Year</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to reset?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ action('Controller_Reset@fun_store_reset_year') }}"
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
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
