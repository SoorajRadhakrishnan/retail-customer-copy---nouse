@extends('Admin.theme')

@section('title', 'ITEM STOCK')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Item Stock</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card rounded-10 shadow">
                            <div class="card-header">
                                <form>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="mb-0 d-block small font-weight-bold">Item Type</label>
                                            <select class="form-control rounded-10 select2" id="item_type" name="item_type"
                                                onchange="this.form.submit()">
                                                <<option value="">Select Item Type</option>
                                                <option value="1" @if ($item_type == '1') selected @endif>
                                                    Salelable Item</option>
                                          @if ((app('appSettings')['production'])->value == 'yes')
                                                <option value="2" @if ($item_type == '2') selected @endif>Raw
                                                    Material</option>
                                           @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3 w-auto">
                                            <label class="mb-0 d-block small font-weight-bold">Item</label>
                                            <select class="form-control rounded-10 select2" id="price_id" name="price_id"
                                                onchange="this.form.submit()">
                                                <option value="">Select Item</option>
                                                 @foreach ($itemList as $item_id)
                                                <?php
                                                if ($item_id->size_name === 'Unit price') {
                                                    $item_id->size_name = '';
                                                }
                                                ?>
                                                <option value="{{ $item_id->price_id }}"
                                                    @if ($item_id->price_id == $price_id) selected="selected" @endif>
                                                    {{ Str::ucfirst($item_id->item_name) }}{{ $item_id->size_name ? ' - ' . $item_id->size_name : '' }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 w-auto">
                                            <label class="mb-0 d-block small font-weight-bold">Category</label>
                                            <select class="form-control rounded-10 select2" id="category_id" name="category_id"
                                                onchange="this.form.submit()">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        @if ($cat->id == $category_id) selected="selected" @endif>
                                                        {{ Str::ucfirst($cat->category_name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ url('admin/stock') }}" method="POST">
                    @csrf
                    <input type="hidden" name="branch_id" value="{{ getbranchid() }}">
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card rounded-10 shadow">
                                    <div class="card-body overflow-auto">
                                        <table id="example" class="table table-hover table-custom border-bottom-0"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    @if (!auth()->user()->branch_id)
                                                        <th>Branch</th>
                                                    @endif
                                                    <th>Item Name</th>
                                                    @if (app('appSettings')['barcode']->value == 'yes')
                                                        <th>Barcode</th>
                                                    @endif
                                                    {{-- <th>Price Size</th> --}}
                                                    <th>Item Type</th>
                                                    <th>Price</th>
                                                    <th>Available Stock</th>
                                                    <th>Unit</th>
                                                    <th>Cost Price</th>
                                                    <th>Enter Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($items) > 0)
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            @if (!auth()->user()->branch_id)
                                                                <td>{{ Str::ucfirst($item->branch->branch_name) }}</td>
                                                            @endif
                                                            <td><?php echo e($item->item ? Str::ucfirst($item->item->item_name) : 'N/A'); ?></td>
                                                            @if (app('appSettings')['barcode']->value == 'yes')
                                                                <td>{{  $item->barcode }}</td>
                                                            @endif
                                                            <td>
                                                                @if ($item->price_item_type == '1')
                                                                    Salable Item
                                                                @elseif ($item->price_item_type == '0')
                                                                    Non-Salable
                                                                @else
                                                                    Raw Material
                                                                @endif
                                                            </td>
                                                            <td>{{ $item->price }}</td>
                                                            <td>{{ $item->stock }}</td>
                                                            <td>{{ Str::ucfirst(getUnitByItemId($item->item_id)) }}</td>
                                                            <td>
                                                                {{-- <input type="hidden" name="cost_price[{{ $item->id }}]" --}}
                                                                {{-- value="{{ $item->cost_price }}"> --}}
                                                                <input type="number" name="cost_price[{{ $item->id }}]"
                                                                    value="{{ $item->cost_price }}"
                                                                    class="form-control w-auto rounded-10">
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="old_stock[{{ $item->id }}]"
                                                                    value="{{ $item->stock }}">
                                                                <input type="number" name="stock_add[{{ $item->id }}]"
                                                                    class="form-control w-auto rounded-10">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="az-dashboard-nav border-0">
                            @if (checkUserPermission('stock_adjust') && getbranchid())
                                <button type="submit" class="btn btn-dark rounded-10 shadoww pull-right">
                                    <i class="fa fa-plus-circle mr-1"></i> Update
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#price_id, #category_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>
@endsection
