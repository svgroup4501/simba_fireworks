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
            $("#discount_in_percentage").on("input", function() {
                calculate_total_amount();
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

            quantity = quantity != "" && quantity > 0 ? quantity : "1";
            rate = rate != "" && rate > 0 ? rate : "1";
            pkt = pkt != "" && pkt > 0 ? pkt : "1";

            var row_total = quantity * rate * pkt;
            document.getElementById("amount").value = parseFloat(row_total).toFixed(2);
        }

        function calculate_particular_amount() {
            var tabel = document.getElementById('item_table');
            var rijen = tabel.rows.length;
            var total_amount = 0;
            var case_count = 0;
            if (rijen > 2) {
                for (iLoop = 0; iLoop < rijen; iLoop++) {
                    var inputs = tabel.rows.item(iLoop).getElementsByTagName("input");
                    var inputslengte = inputs.length;
                    for (var jLoop = 0; jLoop < inputslengte; jLoop++) {
                        var inputval = inputs[jLoop].value;
                        if (inputval != "") {
                            if (jLoop == 1) // Quantity Count
                            {
                                case_count = parseInt(case_count) + parseInt(inputval);
                            }
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
                    if (case_count != "" && case_count > 0) {
                        document.getElementById("case_count").value = case_count;
                    } else {
                        document.getElementById("case_count").value = "0";
                    }
                }
            } else {
                document.getElementById("particular_amount").value = "0.00";
                document.getElementById("total_amount").value = "0.00";
                document.getElementById("tax_amount").value = "0";
                document.getElementById("packing_amount").value = "0";
                document.getElementById("case_count").value = "0";
                document.getElementById("discount_in_percentage").value = "0";
            }
            calculate_total_amount();
        }

        function calculate_total_amount() {
            var final_total_amount = "0.00";
            var tax_amount = parseFloat($("#tax_amount").val());
            var packing_amount = parseFloat($("#packing_amount").val());
            var particular_amount = parseFloat($("#particular_amount").val());
            var discount_percentage = parseFloat($("#discount_in_percentage").val());

            tax_amount = tax_amount != "" && tax_amount > 0 ? tax_amount : parseFloat(0);
            packing_amount = packing_amount != "" && packing_amount > 0 ? packing_amount : parseFloat(0);
            discount_percentage = discount_percentage != "" && discount_percentage > 0 ? discount_percentage : parseFloat(
                0);
            particular_amount = particular_amount != "" && particular_amount > 0 ? particular_amount : parseFloat(0);

            var discount_amount = (particular_amount * discount_percentage) / 100;

            final_total_amount = (particular_amount - discount_amount) + tax_amount + packing_amount;
            document.getElementById("total_amount").value = parseFloat(final_total_amount).toFixed(2);
            document.getElementById("discount_amount").value = parseFloat(discount_amount).toFixed(2);
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
            if (document.getElementById('transport_name').value == "") {
                $("#span_transport_name").html("Empty").show().fadeOut("slow");
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
    </script>
    <meta name="_token" content="{{ csrf_token() }}" />
    @if (isset($particular_collection) && !empty($particular_collection) && $particular_collection->count())
        <form class="form-horizontal" action="{{ action('Controller_Particular@fun_update_particular') }}"
            onsubmit="return validate_form()" method="POST">
            {{ csrf_field() }}
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title pull-left">
                                    Edit Particular
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            @include('input_box_error_message')
                            @include('flash_message')
                            @if (!empty($customer_collection) && $customer_collection->count())
                                @foreach ($customer_collection as $array_collection)
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="customer_inr_id" style="margin-left: 31px"
                                                    class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input id="{{ CUSTOMER_NAME }}" readonly type="text"
                                                        class="form-control" style="margin-left: 145px;margin-top:-31px"
                                                        name="{{ CUSTOMER_NAME }}" value="{!! $array_collection->{CUSTOMER_NAME} !!}" required
                                                        readonly>
                                                    <input id="{{ CUSTOMER_INR_ID }}" readonly type="hidden"
                                                        class="form-control" name="{{ CUSTOMER_INR_ID }}"
                                                        value="{!! $array_collection->{CUSTOMER_INR_ID} !!}" required>
                                                    <input id="{{ PARTICULAR_INR_ID }}" readonly type="hidden"
                                                        class="form-control" name="{{ PARTICULAR_INR_ID }}"
                                                        value="{!! $array_collection->{PARTICULAR_INR_ID} !!}" required>
                                                    <span id="span_customer_name"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="company_name" class="col-md-3 control-label">Company
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="selected_company_inr_id"
                                                        name="selected_company_inr_id">
                                                        @foreach ($company_collection as $single_company)
                                                            <option value="{{ $single_company->company_inr_id }}">
                                                                {{ $single_company->company_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="transport_name" style="text-align:center"
                                                    class="col-md-3 control-label">Transport</label>
                                                <div class="col-sm-9">
                                                    <input id="{{ TRANSPORT_NAME }}" type="text" class="form-control"
                                                        name="{{ TRANSPORT_NAME }}"
                                                        onkeyup="this.value = this.value.toUpperCase();" maxlength="100"
                                                        value="{!! $array_collection->{TRANSPORT_NAME} !!}" required>
                                                    <span id="span_transport_name"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="product_count" style="text-align:center"
                                                    class="col-md-3 control-label">Count</label>
                                                <div class="col-sm-9">
                                                    <input id="{{ PRODUCT_COUNT }}" type="hidden" class="form-control"
                                                        name="{{ PRODUCT_COUNT }}" value="{!! $array_collection->{PARTICULAR_COUNT} !!}"
                                                        readonly>
                                                    <input id="{{ CASE_COUNT }}" type="text" class="form-control"
                                                        name="{{ CASE_COUNT }}" value="{!! $array_collection->{CASE_COUNT} !!}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group row">
                                                <label for="partiuclar_amount" class="col-md-3 control-label">Amount</label>
                                                <div class="col-sm-9">
                                                    <input id="{{ PARTICULAR_AMOUNT }}" type="text" class="form-control"
                                                        name="{{ PARTICULAR_AMOUNT }}" value="{!! $array_collection->{PARTICULAR_AMOUNT} !!}"
                                                        readonly>
                                                    <span id="span_particular_amount"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="packing_amount" class="col-md-3 control-label">Discount</label>
                                                <div class="col-md-9">
                                                    <input id="{{ DISCOUNT_IN_PERCENTAGE }}" type="number"
                                                        class="form-control" name="{{ DISCOUNT_IN_PERCENTAGE }}"
                                                        autocomplete="off" value="{!! $array_collection->{DISCOUNT_IN_PERCENTAGE} !!}">
                                                    <input id="{{ DISCOUNT_AMOUNT }}" type="hidden" class="form-control"
                                                        name="{{ DISCOUNT_AMOUNT }}" autocomplete="off"
                                                        value="{!! $array_collection->{DISCOUNT_AMOUNT} !!}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tax_amount" style="text-align:center"
                                                    class="col-md-3 control-label">Tax</label>
                                                <div class="col-md-9">
                                                    <input id="{{ TAX_AMOUNT }}" type="number" class="form-control"
                                                        name="{{ TAX_AMOUNT }}" value="{!! $array_collection->{TAX_AMOUNT} !!}"
                                                        autocomplete="off">
                                                    <span id="span_tax_amount"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="packing_amount" class="col-md-3 control-label">Packing</label>
                                                <div class="col-md-9">
                                                    <input id="{{ PACKING_AMOUNT }}" type="number" class="form-control"
                                                        name="{{ PACKING_AMOUNT }}" value="{!! $array_collection->{PACKING_AMOUNT} !!}"
                                                        autocomplete="off">
                                                    <span id="span_packing_amount"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-3" style="margin-left:-9px">
                                            <div class="form-group row">
                                                <label for="total_amount" class="col-md-3 control-label">Total</label>
                                                <div class="col-md-9">
                                                    <input id="{{ TOTAL_AMOUNT }}" type="number" class="form-control"
                                                        name="{{ TOTAL_AMOUNT }}" value="{!! $array_collection->{AMOUNT} !!}"
                                                        readonly>
                                                    <span id="span_total_amount"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date" class="col-md-3 control-label">Previous Date</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                        value="{!! date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) !!}" readonly>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date" class="col-md-3 control-label">Date</label>
                                                <div class="col-sm-9">
                                                    <input id="{{ DATE_PICKER }}" type="date" class="form-control"
                                                        name="{{ DATE_PICKER }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date" class="col-md-3 control-label">Bill.No</label>
                                                <div class="col-sm-9">
                                                    <input id="{{ BILL_NUMBER }}" type="text" class="form-control"
                                                        name="{{ BILL_NUMBER }}" value="{!! $array_collection->{BILL_NUMBER} !!}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="panel-body">
                                <table class="table table-bordered" id="item_table">
                                    <tr>
                                        <th style="width:38%">Particular</th>
                                        <th style="width:12%">Quantity</th>
                                        <th style="width:14%">Rate</th>
                                        <th style="width:14%">Pkt / Unit</th>
                                        <th style="width:16%">Amount</th>
                                        <th style="width:5%">Action</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input list="datalistproductname" id="{{ PRODUCT_NAME }}"
                                                list="list_product_name" type="text" class="form-control"
                                                name="{{ PRODUCT_NAME }}" value="{{ old(PRODUCT_NAME) }}">
                                            <datalist id="datalistproductname">
                                                @foreach ($product_collection as $array_collection)
                                                    <option value="{!! $array_collection->{PRODUCT_NAME} !!}" />
                                                @endforeach
                                            </datalist>
                                            <span id="span_product_name"></span>
                                        </td>
                                        <td>
                                            <input id="{{ QUANTITY }}" type="number" class="form-control"
                                                name="{{ QUANTITY }}" value="{{ old(QUANTITY) }}"
                                                autocomplete="off">
                                            <span id="span_quantity"></span>
                                        </td>
                                        <td>
                                            <input id="{{ RATE }}" type="number" class="form-control"
                                                name="{{ RATE }}" value="{{ old(RATE) }}"
                                                autocomplete="off">
                                            <span id="span_rate"></span>
                                        </td>
                                        <td>
                                            <input id="{{ PKT }}" type="number" class="form-control"
                                                name="{{ PKT }}" value="{{ old(PKT) }}"
                                                autocomplete="off">
                                            <span id="span_pkt"></span>
                                        </td>
                                        <td>
                                            <input id="{{ AMOUNT }}" type="number" class="form-control"
                                                name="{{ AMOUNT }}" value="{{ old(AMOUNT) }}" readonly>
                                            <span id="span_amount"></span>
                                        </td>
                                        <td>
                                            <button type="button" name="add" class="btn btn-success btn-sm add">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    @if (isset($particular_collection) && !empty($particular_collection) && $particular_collection->count())
                                        @foreach ($particular_collection as $array_collection)
                                            <tr>
                                                <td>
                                                    <input type="text" readonly name="purchased_product_name[]"
                                                        class="form-control product_name"
                                                        value="{!! $array_collection->{PRODUCT_NAME} !!}">
                                                </td>
                                                <td>
                                                    <input type="number" readonly name="purchased_product_quantity[]"
                                                        class="form-control quantity" value="{!! $array_collection->{QUANTITY} !!}">
                                                </td>
                                                <td>
                                                    <input type="number" readonly name="purchased_product_rate[]"
                                                        class="form-control rate" value="{!! $array_collection->{RATE} !!}">
                                                </td>
                                                <td>
                                                    <input type="number" readonly name="purchased_product_pkt[]"
                                                        class="form-control pkt" value="{!! $array_collection->{PKT} !!}">
                                                </td>
                                                <td>
                                                    <input type="number" readonly name="purchased_product_amount[]"
                                                        class="form-control amount" value="{!! $array_collection->{AMOUNT} !!}">
                                                </td>
                                                <td>
                                                    <button type="button" name="remove"
                                                        class="btn btn-danger btn-sm remove">
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                                <div class="form-group ">
                                    <div class="col-md-12">
                                        @foreach ($customer_collection as $array_collection)
                                            <a href="{{ action('Controller_Particular@fun_view_add_particular_with_parameter', [$array_collection->{CUSTOMER_INR_ID}]) }}"
                                                style="float: right;margin-top: 10px" role="button"
                                                class="btn btn-primary">Back</a>
                                        @endforeach
                                        <button type="submit" style="float: right;margin-top: 10px;margin-right: 10px"
                                            class="btn btn-primary">
                                            Click to Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
