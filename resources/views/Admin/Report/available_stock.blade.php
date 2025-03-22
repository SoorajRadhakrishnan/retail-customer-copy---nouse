@extends('Admin.theme')

@section('title', 'AVAILABLE STOCK')

@section('style')

@endsection

@section('content')

<div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
    <div class="container-fluid">
        <div class="az-content-body">
            <div class="col-12">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Available Stock</h2>
                        <p class="az-dashboard-text"></p>
                    </div>
                    <div class="az-content-header-right">
                        <nav class="nav">
                            <a id="createbtn"
                               class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 d-flex justify-content-center align-items-center"
                            href="{{ url('admin/stock-moving-report') }}"> Stock Moving Report</a>
                        </nav>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Item Type</label>
                                        <select class="form-control rounded-10 select2" id="item_type" name="item_type"
                                            onchange="this.form.submit()">
                                            <option value="">Select Item Type</option>
                                            <option value="1"
                                                @if ($item_type == '1') selected @endif>Salelable Item</option>
                                            <option value="2"
                                                @if ($item_type == '2') selected @endif>Raw Material</option>
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Item</label>
                                        <select class="form-control rounded-10 select2" id="price_id" name="price_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select Item</option>
                                            @foreach ($itemList as $item_id)
                                                <option value="{{ $item_id->price_id }}"
                                                    @if ($item_id->price_id == $price_id) selected="selected" @endif>
                                                    {{ Str::ucfirst($item_id->item_name)}}
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
            <div class="col-12 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card rounded-10 shadow">
                            <div class="card-body overflow-auto">
                                <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            @if (!auth()->user()->branch_id)
                                                <th>Branch</th>
                                            @endif
                                            <th>Item Name</th>
                                            <th>Unit</th>
                                            <th>Barcode</th>
                                            <th>Price Size</th>
                                            <th>Item Type</th>
                                            <th>Price</th>
                                            <th>Available Stock</th>
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
                                                    <td>{{ Str::ucfirst($item->item->item_name) }}</td>
                                                    <td>{{ Str::ucfirst(getUnitByItemId($item->item_id)) }}</td>
                                                    <td>{{  $item->barcode }}</td>
                                                   <td>{{ $item->pricesize ? Str::ucfirst($item->pricesize->size_name) : '' }}</td>

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
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('#price_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>

@endsection
