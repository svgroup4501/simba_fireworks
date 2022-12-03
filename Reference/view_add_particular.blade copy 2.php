@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#quantity").on("input", function() {
                calculate_row_total();
            });
            $("#rate").on("input", function() {
                calculate_row_total();
            });
            $("#pkt").on("input", function() {
                calculate_row_total();
            });
        });

        $(document).on('click', '.add', function() {
            var product_name = $("#product_name").val();
            var quantity = $("#quantity").val();
            var rate = $("#rate").val();
            var pkt = $("#pkt").val();
            var amount = $("#amount").val();

            if (document.getElementById('product_name').value == "") {
                $("#span_product_name").html("Empty").show().fadeOut("slow");
                return false;
            }

            if (document.getElementById('quantity').value == "") {
                $("#span_quantity").html("Empty").show().fadeOut("slow");
                return false;
            }

            if (document.getElementById('rate').value == "") {
                $("#span_rate").html("Empty").show().fadeOut("slow");
                return false;
            }

            if (document.getElementById('pkt').value == "") {
                $("#span_pkt").html("Empty").show().fadeOut("slow");
                return false;
            }

            if (document.getElementById('amount').value == "") {
                $("#span_amount").html("Empty").show().fadeOut("slow");
                return false;
            }

            var table = document.getElementById("item_table");
            var row = table.insertRow(2);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);


            var product_name_cell =
                "<input type='text'   readonly name=purchased_product_name[] class='form-control product_name' value='" +
                product_name + "'>";
            var quantity_cell =
                "<input type='number'   readonly  name=purchased_product_quantity[]     class='form-control quantity' value='" +
                quantity + "'>";
            var rate_cell =
                "<input type='number'   readonly  name=purchased_product_rate[]     class='form-control quantity' value='" +
                rate + "'>";
            var pkt_cell =
                "<input type='number'   readonly  name=purchased_product_pkt[]     class='form-control quantity' value='" +
                pkt + "'>";
            var amount_cell =
                "<input type='number' readonly name=purchased_product_amount[]       class='form-control amount'       value='" +
                amount + "'>";
            var remove_button_cell =
                "<button type='button'         name=remove       class='btn btn-danger btn-sm remove'><span class='glyphicon glyphicon-minus'>";

            cell1.innerHTML = product_name_cell;
            cell2.innerHTML = quantity_cell;
            cell3.innerHTML = rate_cell;
            cell4.innerHTML = pkt_cell;
            cell5.innerHTML = amount_cell;
            cell6.innerHTML = remove_button_cell;

            add_product_count(); // Add Product Count
            clear_all_table_input_fields();
            document.getElementById("product_name").focus();
            calculate_total_amount();
        });

        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
            add_product_count(); // Calculate Product Count
            clear_all_table_input_fields();
            document.getElementById("product_name").focus();
            calculate_total_amount();
        });

        function add_product_count() {
            var rowCount = document.getElementById('item_table').rows.length;
            document.getElementById('product_count').value = rowCount - 2;
        }

        function calculate_row_total() {
            var quantity = parseFloat($("#quantity").val());
            var rate = parseFloat($("#rate").val());
            var pkt = parseFloat($("#pkt").val());
            if (quantity != "" && rate != "" && pkt != "") {
                var row_total = quantity * rate * pkt;
                document.getElementById("amount").value = parseFloat(row_total).toFixed(2);
            }
        }

        function calculate_total_amount() {
            var tabel = document.getElementById('item_table');
            var rijen = tabel.rows.length;
            var total_amount = 0;
            if (rijen > 2) {
                for (iLoop = 0; iLoop < rijen; iLoop++) {
                    var inputs = tabel.rows.item(iLoop).getElementsByTagName("input");
                    var inputslengte = inputs.length;
                    for (var jLoop = 0; jLoop < inputslengte; jLoop++) {
                        var inputval = inputs[jLoop].value;
                        if (inputval != "") {
                            if (jLoop == 4) // Amount
                            {
                                total_amount = parseFloat(total_amount) + parseFloat(inputval);
                            }
                        }
                    }
                    document.getElementById("total_amount").value = parseFloat(total_amount).toFixed(2);
                }
            } else {
                document.getElementById("total_amount").value = "0.00";
            }
        }

        function clear_all_table_input_fields() {
            document.getElementById("product_name").value = "";
            document.getElementById("quantity").value = "";
            document.getElementById("rate").value = "";
            document.getElementById("pkt").value = "";
            document.getElementById("amount").value = "";
        }

        function validate_form() {
            clear_all_table_input_fields();

            if (document.getElementById('customer_name').value == "") {
                $("#span_customer_name").html("Empty").show().fadeOut("slow");
                return false;
            }

            if (document.getElementById('total_amount').value == "") {
                $("#span_total_amount").html("Empty").show().fadeOut("slow");
                return false;
            }
            var tabel = document.getElementById('item_table');
            var rijen = tabel.rows.length;

            if (rijen <= 2) {
                $("#span_product_name").html("Empty").show().fadeOut("slow");
                return false;
            }
            return true;
        }
    </script>
    <meta name="_token" content="{{ csrf_token() }}" />
    <form class="form-horizontal" action="{{ action('Controller_Particular@fun_store_particular') }}"
        onsubmit="return validate_form()" method="POST">
        {{ csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9 col-md-6 col-lg-8" style="margin-top: -5px">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            @include('input_box_error_message')
                            @include('flash_message')
                            <div class="form-group" style="float: left;margin-right: -17px;">
                                <label for="product_count" class="col-md-4 control-label"
                                    style="
                                margin-left: -17px;">Count</label>
                                <div class="col-md-4">
                                    <input id="product_count" type="text" class="form-control" name="email"
                                        value="0" readonly>
                                </div>
                            </div>
                            <div class="form-group" style="float: left; margin-left:-131px">
                                <label for="invoiceTotal" class="col-md-4 control-label">Amount</label>
                                <div class="col-md-8">
                                    <input id="{{ TOTAL_AMOUNT }}" readonly type="text" class="form-control"
                                        name="{{ TOTAL_AMOUNT }}" value="0.00">
                                    <span id="span_total_amount"></span>
                                </div>
                            </div>
                            <div class="form-group" style="float: left; margin-left:-1px">
                                <label for="customer_inr_id" class="col-md-2 control-label">Name</label>
                                <div class="col-md-10">
                                    @php
                                        $customer_name = DB::table('customer')
                                            ->where('customer_inr_id', $customer_inr_id)
                                            ->value('customer_name');
                                    @endphp
                                    <input id="{{ CUSTOMER_NAME }}" readonly type="text" class="form-control"
                                        name="{{ CUSTOMER_NAME }}" style="width: 300px;" value="{{ $customer_name }}"
                                        required readonly>
                                    <input id="{{ CUSTOMER_INR_ID }}" readonly type="hidden" class="form-control"
                                        name="{{ CUSTOMER_INR_ID }}" value="{{ $customer_inr_id }}" required readonly>
                                    <span id="span_customer_name"></span>
                                </div>
                            </div>
                            @php
                                $is_show_view_particular = DB::table('particular')->count() > 0 ? true : false;
                            @endphp

                            @if ($is_show_view_particular)
                                <a href="{{ action('Controller_Particular@fun_view_all_particular') }}">
                                    <button type="button" style="float: right;margin-right: 10px" class="btn btn-primary">
                                        View Particular
                                    </button>
                                </a>
                            @endif
                            <div class="panel-body">
                                <table class="table table-bordered" id="item_table">
                                    <tr>
                                        <th style="width:50%">Particular</th>
                                        <th style="width:10%">Quantity</th>
                                        <th style="width:10%">Rate</th>
                                        <th style="width:10%">Pkt / Unit</th>
                                        <th style="width:15%">Amount</th>
                                        <th style="width:10%">Action</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input id="{{ PRODUCT_NAME }}" list="list_product_name" type="text"
                                                class="form-control" name="{{ PRODUCT_NAME }}"
                                                value="{{ old(PRODUCT_NAME) }}">
                                            <span id="span_product_name"></span>
                                        </td>
                                        <td>
                                            <input id="{{ QUANTITY }}" type="number" class="form-control"
                                                name="{{ QUANTITY }}" value="{{ old(QUANTITY) }}">
                                            <span id="span_quantity"></span>
                                        </td>
                                        <td>
                                            <input id="{{ RATE }}" type="number" class="form-control"
                                                name="{{ RATE }}" value="{{ old(RATE) }}">
                                            <span id="span_rate"></span>
                                        </td>
                                        <td>
                                            <input id="{{ PKT }}" type="number" class="form-control"
                                                name="{{ PKT }}" value="{{ old(PKT) }}">
                                            <span id="span_pkt"></span>
                                        </td>
                                        <td>
                                            <input id="{{ AMOUNT }}" type="number" class="form-control"
                                                name="{{ AMOUNT }}" value="{{ old(AMOUNT) }}" readonly>
                                            <span id="span_amount"></span>
                                        </td>
                                        <td><button type="button" name="add" class="btn btn-success btn-sm add"><span
                                                    class="glyphicon glyphicon-plus"></span></button></td>
                                    </tr>
                                </table>
                                <div class="form-group ">
                                    <div class="col-md-12">
                                        <a href="/" style="float: right;margin-top: 10px" role="button"
                                            class="btn btn-primary">Back</a>
                                        <button type="submit" style="float: right;margin-top: 10px;margin-right: 10px"
                                            class="btn btn-primary">
                                            Click to Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 col-md-6 col-lg-4 table-responsive" style="margin-top: -5px">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:10%">Sl.No</th>
                                <th style="width:22%">Date</th>
                                <th style="width:22%">Debit</th>
                                <th style="width:22%">Credit</th>
                                <th style="width:22%">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($account_collection) && $account_collection->count())
                                <?php $previous_balance = 0; ?>
                                @foreach ($account_collection as $array_collection)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) }}</td>
                                        <td><?php echo number_format($array_collection->{DEBIt_AMOUNT}, 2); ?></td>
                                        <td><?php echo number_format($array_collection->{CREDIT_AMOUNT}, 2); ?></td>

                                        <?php
                                        $balance = 0;
                                        if ($loop->index == 0) {
                                            if ($array_collection->{DEBIt_AMOUNT}) {
                                                $balance = $array_collection->{DEBIt_AMOUNT};
                                                $previous_balance = $previous_balance + $array_collection->{DEBIt_AMOUNT};
                                            }
                                            if ($array_collection->{CREDIT_AMOUNT}) {
                                                $balance = $array_collection->{CREDIT_AMOUNT};
                                                $previous_balance = $previous_balance - $array_collection->{CREDIT_AMOUNT};
                                            }
                                        } else {
                                            if ($array_collection->{DEBIt_AMOUNT}) {
                                                $balance = $previous_balance + $array_collection->{DEBIt_AMOUNT};
                                                $previous_balance = $previous_balance + $array_collection->{DEBIt_AMOUNT};
                                            }
                                            if ($array_collection->{CREDIT_AMOUNT}) {
                                                $balance = $previous_balance - $array_collection->{CREDIT_AMOUNT};
                                                $previous_balance = $previous_balance - $array_collection->{CREDIT_AMOUNT};
                                            }
                                        }
                                        ?>
                                        <td><?php echo number_format($balance, 2); ?></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (!empty($account_collection) && $account_collection->count())
                    <a href="{{ action('Controller_Print@fun_print_account', [$customer_inr_id]) }}">
                        <button type="button" style="float: right;margin-right: 29px;margin-top: 10px"
                            class="btn btn-primary">
                            Click to Print
                        </button>
                    </a>
                @endif
            </div>
        </div>
    </form>
@endsection
