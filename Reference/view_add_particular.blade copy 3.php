@extends('layouts.app')

@section('content')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
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
            $("#tax_amount").on("input", function() {
                calculate_total_amount();
            });
            $("#packing_amount").on("input", function() {
                calculate_total_amount();
            });
        });

        $(document).on('click', '.add', function() {
            var product_name = ($("#product_name").val()).toUpperCase();
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
            calculate_particular_amount();
        });

        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
            add_product_count(); // Calculate Product Count
            clear_all_table_input_fields();
            document.getElementById("product_name").focus();
            calculate_particular_amount();
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

        function calculate_particular_amount() {
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
                    if (total_amount != "" && total_amount > 0) {
                        document.getElementById("particular_amount").value = parseFloat(total_amount).toFixed(2);
                    } else {
                        document.getElementById("particular_amount").value = "0.00";
                    }
                }
            } else {
                document.getElementById("particular_amount").value = "0.00";
            }
            calculate_total_amount();
        }

        function calculate_total_amount() {
            var final_total_amount = "0.00";
            var tax_with_particular_amount = "0.00";
            var packing_with_particular_amount = "0.00";
            var tax_amount = parseFloat($("#tax_amount").val());
            var packing_amount = parseFloat($("#packing_amount").val());
            var particular_amount = parseFloat($("#particular_amount").val());

            if (tax_amount != "" && tax_amount > 0 && packing_amount != "" && packing_amount > 0) {
                final_total_amount = particular_amount + tax_amount + packing_amount;
            } else {
                if (tax_amount != "" && tax_amount > 0) {
                    final_total_amount = particular_amount + tax_amount;
                }

                if (packing_amount != "" && packing_amount > 0) {
                    final_total_amount = particular_amount + packing_amount;
                }
            }

            if (final_total_amount != "" && final_total_amount > 0) {
                document.getElementById("total_amount").value = parseFloat(final_total_amount).toFixed(2);
            } else {
                if (particular_amount != "" && particular_amount > 0) {
                    document.getElementById("total_amount").value = parseFloat(particular_amount).toFixed(2);
                } else {
                    document.getElementById("total_amount").value = "0.00";
                }

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
            if (document.getElementById('company_name').value == "") {
                $("#span_company_name").html("Empty").show().fadeOut("slow");
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

        function validate_credit_form() {
            if (document.getElementById('customer_name').value == "") {
                $("#span_credit_amount").html("Empty").show().fadeOut("slow");
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
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="customer_inr_id" style="margin-left: -27px"
                                        class="col-md-4 control-label">Name</label>
                                    <div class="col-md-8">
                                        @php
                                            $customer_name = DB::table('customer')
                                                ->where('customer_inr_id', $customer_inr_id)
                                                ->value('customer_name');
                                        @endphp
                                        <input id="{{ CUSTOMER_NAME }}" style="width: 230px;" readonly type="text"
                                            class="form-control" name="{{ CUSTOMER_NAME }}" value="{{ $customer_name }}"
                                            required readonly>

                                        <input id="{{ CUSTOMER_INR_ID }}" readonly type="hidden" class="form-control"
                                            name="{{ CUSTOMER_INR_ID }}" value="{{ $customer_inr_id }}" required>
                                        <span id="span_customer_name"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="company_name" style="margin-left: -2px"
                                        class="col-md-6 control-label">Company Name</label>
                                    <div class="col-md-6">
                                        <input id="{{ COMPANY_NAME }}" type="text" class="form-control"
                                            name="{{ COMPANY_NAME }}"
                                            style="width: 260px;margin-left:-19px;text-transform:uppercase" required>
                                        <span id="span_company_name"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="product_count" style="margin-left: 48px"
                                        class="col-md-4 control-label">Count</label>
                                    <div class="col-md-6">
                                        <input id="{{ PRODUCT_COUNT }}" type="text" class="form-control"
                                            name="{{ PRODUCT_COUNT }}" value="0" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-sm-3">
                                    <label for="partiuclar_amount" class="col-md-4 control-label">Amount</label>
                                    <div class="col-md-8">
                                        <input id="{{ PARTICULAR_AMOUNT }}" type="text" class="form-control"
                                            name="{{ PARTICULAR_AMOUNT }}" style="width:140px" value="0.00" readonly>
                                        <span id="span_particular_amount"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="tax_amount" class="col-md-4 control-label">Tax</label>
                                    <div class="col-md-8">
                                        <input id="{{ TAX_AMOUNT }}" type="number" class="form-control"
                                            name="{{ TAX_AMOUNT }}" style="width: 140px;">
                                        <span id="span_tax_amount"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="packing_amount" class="col-md-4 control-label">Packing</label>
                                    <div class="col-md-8">
                                        <input id="{{ PACKING_AMOUNT }}" type="number" class="form-control"
                                            name="{{ PACKING_AMOUNT }}" style="width: 140px">
                                        <span id="span_packing_amount"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="toal_amount" style="margin-left:-18px"
                                        class="col-md-4 control-label">Total</label>
                                    <div class="col-md-8">
                                        <input id="{{ TOTAL_AMOUNT }}" type="number" class="form-control"
                                            name="{{ TOTAL_AMOUNT }}" style="width: 151px;margin-left:-17px"
                                            value="0.00" readonly>
                                        <span id="span_total_amount"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered" id="item_table">
                                    <tr>
                                        <th style="width:30%">Particular</th>
                                        <th style="width:12%">Quantity</th>
                                        <th style="width:12%">Rate</th>
                                        <th style="width:12%">Pkt / Unit</th>
                                        <th style="width:20%">Amount</th>
                                        <th style="width:5%">Action</th>
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
                                        <td><button type="button" name="add"
                                                class="btn btn-success btn-sm add"><span
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
                <div class="col-sm-3 col-md-6 col-lg-4 " style="margin-top: -5px">
                    <div class="row table-responsive">
                        <div class="column">
                            <table class="table table-bordered ">
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
                                        <?php $previous_balance = 0;
                                        $balance = 0;
                                        $total_credit = 0;
                                        $total_debit = 0;
                                        $remaining_balance = 0; ?>
                                        @foreach ($account_collection as $array_collection)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) }}</td>
                                                <td><?php echo number_format($array_collection->{DEBIt_AMOUNT}, 2); ?></td>
                                                <td><?php echo number_format($array_collection->{CREDIT_AMOUNT}, 2); ?></td>

                                                <?php
                                                
                                                if ($loop->index == 0) {
                                                    if ($array_collection->{DEBIt_AMOUNT}) {
                                                        $balance = $array_collection->{DEBIt_AMOUNT};
                                                        $total_debit = $total_debit + $array_collection->{DEBIt_AMOUNT};
                                                        $previous_balance = $previous_balance + $array_collection->{DEBIt_AMOUNT};
                                                    }
                                                    if ($array_collection->{CREDIT_AMOUNT}) {
                                                        $balance = $array_collection->{CREDIT_AMOUNT};
                                                        $total_credit = $total_credit + $array_collection->{CREDIT_AMOUNT};
                                                        $previous_balance = $previous_balance - $array_collection->{CREDIT_AMOUNT};
                                                    }
                                                } else {
                                                    if ($array_collection->{DEBIt_AMOUNT}) {
                                                        $balance = $previous_balance + $array_collection->{DEBIt_AMOUNT};
                                                        $total_debit = $total_debit + $array_collection->{DEBIt_AMOUNT};
                                                        $previous_balance = $previous_balance + $array_collection->{DEBIt_AMOUNT};
                                                    }
                                                    if ($array_collection->{CREDIT_AMOUNT}) {
                                                        $balance = $previous_balance - $array_collection->{CREDIT_AMOUNT};
                                                        $total_credit = $total_credit + $array_collection->{CREDIT_AMOUNT};
                                                        $previous_balance = $previous_balance - $array_collection->{CREDIT_AMOUNT};
                                                    }
                                                }
                                                ?>
                                                <td><?php echo number_format($balance, 2); ?></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php echo number_format($total_debit, 2); ?></b></td>
                                            <td><b><?php echo number_format($total_credit, 2); ?></b></td>
                                            <td><b><?php echo number_format($total_debit - $total_credit, 2); ?></b></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (!empty($account_collection) && $account_collection->count())
                        <a target="_blank" href="{{ action('Controller_Print@fun_print_account', [$customer_inr_id]) }}">
                            <button type="button"
                                style="width:115px;float:right;margin-right: -3px;margin-top: -8px;margin-bottom: 5px"
                                class="btn btn-primary">
                                Click to Print
                            </button>
                        </a>
                    @endif
                    <div class="row table-responsive" style="margin-top:52px">
                        <div class="column">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th style="width:10%">Sl.No</th>
                                        <th style="width:30%">Date</th>
                                        <th style="width:50%">Name</th>
                                        <th style="width:10%">Amount</th>
                                        <th style="width:10%">View</th>
                                        <th style="width:10%">Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($particular_collection) && $particular_collection->count())
                                        @foreach ($particular_collection as $array_collection)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) }}</td>
                                                <td>{!! $array_collection->{CUSTOMER_NAME} !!}</td>
                                                <td>{!! $array_collection->{AMOUNT} !!}</td>
                                                <td>
                                                    <p data-placement="top" data-toggle="tooltip" title="View">
                                                        <a href="{{ action('Controller_Particular@fun_view_single_particular', [$array_collection->{PARTICULAR_INR_ID}]) }}"
                                                            class="btn btn-primary btn-sm" role="button"
                                                            data-toggle="modal">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Add Credit Modal -->
    <div id="add_Credit" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Credit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" onsubmit="return validate_credit_form()" method="POST"
                        action="{{ action('Controller_Credit@fun_store_credit') }}">
                        {{ csrf_field() }}
                        <input id="{{ CUSTOMER_INR_ID }}" type="hidden" class="form-control"
                            name="{{ CUSTOMER_INR_ID }}" value="{{ $customer_inr_id }}" required readonly>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Amount</label>
                            <div class="col-md-6">
                                <input id="{{ CREDIT_AMOUNT }}" type="number" class="form-control"
                                    name="{{ CREDIT_AMOUNT }}" required>
                                <span id="span_credit_amount"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Click to Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
