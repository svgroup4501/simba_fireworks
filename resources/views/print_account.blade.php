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
</style>

<body>
    <img src="{{URL::asset('image/print_header.png')}}" alt="SIMBA" style="margin-top:10px;margin-left:70px">
    @if (!empty($customer_collection) && $customer_collection->count())
        @foreach ($customer_collection as $array_collection)
            <p style="text-align:left;">Name: {{ $array_collection->{CUSTOMER_NAME} }}</p>
            <p style="text-align:left;">Address:
                {{ $array_collection->{CUSTOMER_ADDRESS} ? $array_collection->{CUSTOMER_ADDRESS} : '------' }}</p>
            <p style="text-align:left;">Mobile:
                {{ $array_collection->{MOBILE} ? $array_collection->{MOBILE} : '------' }}</p>
            <p style="text-align:left;">GST:
                {{ $array_collection->{CUSTOMER_GST} ? $array_collection->{CUSTOMER_GST} : '------' }}</p>
        @endforeach
    @endif

    <table class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width:10%">Sl.No</th>
                <th style="width:20%">Date</th>
                <th style="width:40%">Company Name</th>
                <th style="width:10%">Debit</th>
                <th style="width:10%">Credit</th>
                <th style="width:10%">Balance</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($account_collection) && $account_collection->count())
                <?php $previous_balance = 0;
                $total_credit = 0;
                $total_debit = 0; ?>
                @foreach ($account_collection as $array_collection)
                    <tr>
                        <td style="width:10%;">{{ $loop->index + 1 }}</td>
                        <td style="width:20%;margin-left:20px">
                            {{ date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) }}</td>
                        <td style="width:20%;margin-left:20px">
                            {{ $array_collection->{COMPANY_NAME} }}</td>
                        @php
                            $show_debit_amount = $array_collection->{DEBIt_AMOUNT} ? number_format($array_collection->{DEBIt_AMOUNT}, 2) : '------';
                            $show_credit_amount = $array_collection->{CREDIT_AMOUNT} ? number_format($array_collection->{CREDIT_AMOUNT}, 2) : '------';
                        @endphp
                        @endphp
                        <td style="width:22%;margin-left:20px"><?php echo $show_debit_amount; ?></td>
                        <td style="width:22%;margin-left:20px"><?php echo $show_credit_amount; ?></td>

                        <?php
                        $balance = 0;
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
                        <td style="width:22%;margin-left:20px"><?php echo number_format($balance, 2); ?></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if (!empty($account_collection) && $account_collection->count())
        <p style="text-align:right;">Debit : <b><?php echo number_format($total_debit, 2); ?></b></p>
        <p style="text-align:right;">Credit : <b><?php echo number_format($total_credit, 2); ?></b></p>
        <p style="text-align:right;">Balance : <b><?php echo number_format($total_debit - $total_credit, 2); ?></b></p>
    @endif
</body>

</html>
