<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 5px;
        text-align: center;
    }

    .page-break {
        page-break-after: always;
    }
</style>

<body>
    <img src="{{ URL::asset('image/print_header.png') }}" alt="SIMBA" style="margin-top:10px;margin-left:70px">
    @if (!empty($particular_collection) && $particular_collection->count())
           <?php $particular_count = 1; ?>
        @foreach ($particular_collection as $array_collection)
            <p style="text-align:left;">Bill No: {{ $array_collection->{BILL_NUMBER} }}</p>
            <p style="text-align:left;">Customer Name: {{ $array_collection->{CUSTOMER_NAME} }}</p>
            <p style="text-align:left;">Company Name: {{ $array_collection->{COMPANY_NAME} }}</p>
            <p style="text-align:left;">Total Amount: {{ $array_collection->{AMOUNT} }}</p>
            <p style="text-align:left;">Transport Name: {{ $array_collection->{TRANSPORT_NAME} }}</p>
            <p style="text-align:left;">Total No.of Cases: {{ $array_collection->{CASE_COUNT} }}</p>
            <p style="text-align:right;margin-top:-80px">Date:
                {{ date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) }}
            </p>
            <?php
            $particular_product_collection = DB::table(TB_PARTICULAR_DETAIL)
                ->where(PARTICULAR_INR_ID, $array_collection->{PARTICULAR_INR_ID})
                ->get();
            ?>
            <table class="table table-bordered" style="width:100%;margin-bottom:-2px">
                <thead>
                    <tr>
                        <th style="width:10%">Sl.No</th>
                        <th style="width:35%">Particular</th>
                        <th style="width:10%">Quantity</th>
                        <th style="width:15%">Rate</th>
                        <th style="width:15%">Pkt / Unit</th>
                        <th style="width:15%">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($particular_product_collection) && $particular_product_collection->count())
                        @foreach ($particular_product_collection as $array_product_collection)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{!! $array_product_collection->{PRODUCT_NAME} !!}</td>
                                <td>{!! $array_product_collection->{QUANTITY} !!}</td>
                                <td>{!! $array_product_collection->{RATE} !!}</td>
                                <td>{!! $array_product_collection->{PKT} !!}</td>
                                <td>{!! $array_product_collection->{AMOUNT} !!}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">There are no data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <p>
                @if (isset($array_collection->{BILL_NAME}) && !empty($array_collection->{BILL_NAME}))
                    <?php $receipt_path = storage_path() . '/app/receipt/' . $array_collection->{BILL_NAME}; ?>
                    <img src="<?php echo $receipt_path; ?>" alt="receipt" style="width:350px;heigth:350px" />
                @endif
            </p>
            <table align="right" class="table table-bordered" style="width:45.5%;margin-top:-400px">
                <tbody>
                    <tr>
                        <td style="width:66.5%">Particular Amount</td>
                        <td style="width:33.5%"><?php echo number_format($array_collection->{PARTICULAR_AMOUNT}, 2); ?></td>
                    </tr>
                    <tr>
                        <td style="width:66.5%">Discount Amount({!! $array_collection->{DISCOUNT_IN_PERCENTAGE} !!}%)</td>
                        <td style="width:33.5%"><?php echo number_format($array_collection->{DISCOUNT_AMOUNT}, 2); ?></td>
                    </tr>
                    <tr>
                        <td style="width:66.5%">Packing Amount({!! $array_collection->{PACKING_AMOUNT} !!}%)</td>
                        <td style="width:33.5%"><?php echo number_format($array_collection->{PACKING_PERCENTAGE}, 2); ?></td>
                    </tr>
                    <tr>
                        <td style="width:66.5%">Tax Amount</td>
                        <td style="width:33.5%"><?php echo number_format($array_collection->{TAX_AMOUNT}, 2); ?></td>
                    </tr>
                    <tr>
                        <td style="width:66.5%">Total Amount</td>
                        <td style="width:33.5%"><b><?php echo number_format($array_collection->{AMOUNT}, 2); ?></b></td>
                    </tr>
                </tbody>
            </table>
	 @if ($particular_collection->count() != $particular_count)
<?php $particular_count =  $particular_count + 1; ?>
            <div class="page-break"></div>
	  @endif
        @endforeach
    @else
        <table class="table table-bordered" style="width:100%;margin-bottom:-2px">
            <thead>
                <tr>
                    <th style="width:10%">Sl.No</th>
                    <th style="width:35%">Particular</th>
                    <th style="width:10%">Quantity</th>
                    <th style="width:15%">Rate</th>
                    <th style="width:15%">Pkt / Unit</th>
                    <th style="width:15%">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            </tbody>
        </table>
    @endif

</body>

</html>
