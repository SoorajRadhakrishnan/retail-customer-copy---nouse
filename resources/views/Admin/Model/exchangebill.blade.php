<!-- filepath: /c:/xampp1/htdocs/ZAAD/zaad-retail/retail.zaad1.com/resources/views/Admin/Model/exchangebill.blade.php -->

<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Previous Bill</h5>
</div>
<div class="col-12 p-0">
    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
        <table id="example" class="table table-custom" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%">S.No</th>
                    {{-- <th>Receipt ID</th> --}}
                    <th>Ordered Date</th>
                    <th>Order Type</th>
                    {{-- <th>Delivery Type</th> --}}
                    <th>Customer</th>
                    <th>Payment Type</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th>Changed Items</th>
                </tr>
            </thead>
            <tbody>
                @if ($exchangeBill)
                    <tr>
                        <td style="width: 5%">1</td>
                        {{-- <td>{{ $exchangeBill->receipt_id }}</td> --}}
                        <td>{{ dateFormat($exchangeBill->ordered_date, 1) }}</td>
                        <td>{{ Str::ucfirst(str_replace('_', ' ', $exchangeBill->order_type)) }}</td>
                        {{-- <td>{{ Str::ucfirst(str_replace('_', ' ', $exchangeBill->delivery_type)) }}</td> --}}
                        <td>{{ $exchangeBill->customer_number ? Str::ucfirst($exchangeBill->customer_name) . ' (' . $exchangeBill->customer_number . ')' : '' }}</td>
                        <td>{{ $exchangeBill->payment_type }}</td>
                        <td>{{ showAmount($exchangeBill->without_tax) }}</td>
                        <td>{{ showAmount($exchangeBill->discount) }}</td>
                        <td>{{ showAmount($exchangeBill->with_tax) }}</td>
                        <td>{{ $exchangeBill->changed_items }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="11">No records found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
            data-dismiss="modal">Close</button>
    </div>
</div>
