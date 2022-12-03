@extends('layouts.app')
@section('content')
    <script>
        function validate_form( $user_id )
        {
            $clicked_span_user_id  = 'span_password_'+$user_id;
            $clicked_input_user_id = 'password_'+$user_id;

             if (document.getElementById($clicked_input_user_id).value == "")
            {
                $('#'+$clicked_span_user_id).html("Empty").show().fadeOut("slow");
                return false;
            }
            return true;
        }
    </script>

    @if( isset( $user_collection ) && !empty( $user_collection ) )
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">View User</div>
                        @include('input_box_error_message')
                        @include('flash_message')
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Sl.No</th>
                                    <th>UserName</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                <?php $iLoop = ONE ;?>
                                @foreach( $user_collection as $array_collection )
                                    <tr>
                                        <td><?php echo $iLoop;?></td>
                                        <td>{!! $array_collection->{ USERNAME }!!}</td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Edit">
                                                <a href="#edit_user_modal_{{ $array_collection->{ USER_INR_ID }  }}" class="btn btn-primary btn-sm" role="button" data-toggle="modal">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </a>
                                            </p>
                                            <!-- EDIT Modal HTML -->
                                            <div id="edit_user_modal_{{ $array_collection->{ USER_INR_ID }  }}" class="modal fade">
                                                <div class="modal-dialog modal-confirm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit User</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="panel-body">
                                                            <form class="form-horizontal" onsubmit="return validate_form({{ $array_collection->{ USER_INR_ID }  }})" method="POST" action="{{ action ( 'Controller_User@fun_update_user' , $array_collection->{ USER_INR_ID } ) }}">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label for="name" class="col-md-4 control-label">User Name</label>
                                                                    <div class="col-md-6">
                                                                        <input id="{{ USERNAME }}" readonly type="text"  maxlength="15" class="form-control" name="{{ USERNAME }}" value="{{ $array_collection->{ USERNAME }  }}"  >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-md-4 control-label">Password</label>
                                                                    <div class="col-md-6">
                                                                        <input id="password_{{ $array_collection->{ USER_INR_ID }  }}" type="password" maxlength="15" class="form-control" name="{{ PASSWORD }}" value="" autofocus required>
                                                                        <span id="span_password_{{ $array_collection->{ USER_INR_ID }  }}"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-md-offset-4">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Click to Update
                                                                        </button>
                                                                        <a  href="#" data-dismiss="modal" role="button" class="btn btn-primary">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                <a href="#delete_user_modal_{{ $array_collection->{ USER_INR_ID }  }}" class="btn btn-danger btn-sm" role="button" data-toggle="modal">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </p>
                                            <!-- Delete Modal HTML -->
                                            <div id="delete_user_modal_{{ $array_collection->{ USER_INR_ID }  }}" class="modal fade">
                                                <div class="modal-dialog modal-confirm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete User - {{ $array_collection->{ USERNAME }  }}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this record ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ action ( 'Controller_User@fun_delete_user' , [ $array_collection->{ USER_INR_ID } ] ) }}"
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
                                        </td>
                                        <?php $iLoop = $iLoop + 1 ;?>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
