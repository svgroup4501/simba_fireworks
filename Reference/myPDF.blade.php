 <!DOCTYPE html>
 <html>

 <head>
     <title>Hi</title>
 </head>

 <body>
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-12">
                 <div class="panel panel-default">
                     <div class="panel-heading">View Invoice</div>
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
                                         <td style="width:10%;">{{ $loop->index + 1 }}</td>
                                         <td style="width:22%;margin-left:20px">
                                             {{ date('d-m-Y', strtotime($array_collection->{CREADTED_AT})) }}</td>
                                         <td style="width:22%;margin-left:20px"><?php echo number_format($array_collection->{DEBIt_AMOUNT}, 2); ?></td>
                                         <td style="width:22%;margin-left:20px"><?php echo number_format($array_collection->{CREDIT_AMOUNT}, 2); ?></td>

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
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>
