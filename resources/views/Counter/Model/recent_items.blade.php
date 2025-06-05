<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Items</h5>
</div>
<div class="col-12 p-0">
    <div class="modal-body" style="max-height: 70vh !important; ">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th class="py-2 bg-transparent text-center">S.NO</th>
                    <th class="py-2 bg-transparent text-center">Item</th>
                    <th class="py-2 bg-transparent text-center">Qty</th>
                    <th class="py-2 bg-transparent text-center">Unit Price</th>
                    <th class="py-2 bg-transparent text-center">Discount</th>
                    <th class="py-2 bg-transparent text-center">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item_list as $key => $item)
                    <tr>
                        <td class="py-2 bg-transparent text-center">{{ ($key+1) }}</td>
                        <td class="py-2 bg-transparent text-center">{{ $item->item_name }}</td>
                        <td class="py-2 bg-transparent text-center">{{ $item->qty }}</td>
                        <td class="py-2 bg-transparent text-center">{{ $item->item_unit_price }}</td>
                        <td class="py-2 bg-transparent text-center">
                            {{ $item->discount_amount ?? $item->discount ?? $item->discount_percent }}
                        </td>
                        <td class="py-2 bg-transparent text-center">
                            {{ showAmount($item->total_price ?? $item->price) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
            data-dismiss="modal">close</button>
    </div>
</div>

