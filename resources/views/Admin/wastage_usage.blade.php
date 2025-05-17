@extends('Admin.theme')

@section('title', 'WASTAGE USAGE')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Wastage Usage</h2>
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
                                                <option value="">Select Item Type</option>
                                                <option value="1" {{ $item_type == 1 ? 'selected' : '' }}>Salelable
                                                    Item</option>
                                                <option value="2" {{ $item_type == 2 ? 'selected' : '' }}>Raw Material
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0 d-block small font-weight-bold">Item</label>
                                            <select class="form-control rounded-10 select2" id="item_id" name="item_id"
                                                onchange="this.form.submit()">
                                                <option value="">Select Item</option>
                                                @foreach ($itemList as $item_id)
                                                    <?php
                                                    if ($item_id->size_name === 'Unit price') {
                                                        $item_id->size_name = ''; // Clear size_name
                                                    } else {
                                                        $item_id->size_name = ' - ' . $item_id->size_name;
                                                    }
                                                    ?>
                                                    <option value="{{ $item_id->price_id }}"
                                                        @if ($item_id->price_id == $price_id) selected="selected" @endif>
                                                        {{ $item_id->item_name . $item_id->size_name }}
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
                <form action="{{ url('admin/wastage-usage') }}" method="POST">
                    @csrf
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
                                                    <th>Available Stock</th>
                                                    <th>Wastage</th>
                                                    <th>Usage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($items) > 0)
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td> <!-- S.No -->
                                                            @if (!auth()->user()->branch_id)
                                                                <td>{{ Str::ucfirst($item->branch->branch_name) }}</td>
                                                            @endif
                                                            <input type="hidden" name="item_id[]"
                                                                value="{{ $item->item_id }}">
                                                            <input type="hidden" name="price_id[]"
                                                                value="{{ $item->id }}">
                                                            <input type="hidden" name="branch_id[]"
                                                                value="{{ $item->branch_id }}">
                                                            <input type="hidden" name="stock[]"
                                                                value="{{ $item->stock }}">
                                                            <td>{{ Str::ucfirst($item->item->item_name ?? 'N/A') }}</td>
                                                            <td>{{ $item->stock }}</td>
                                                            <td>
                                                                <input type="number" name="wastage_qty[]"
                                                                    class="form-control w-auto rounded-10"
                                                                    placeholder="Enter Wastage">
                                                            </td> <!-- Wastage -->
                                                            <td>
                                                                <input type="number" name="usage_qty[]"
                                                                    class="form-control w-auto rounded-10"
                                                                    placeholder="Enter Usage">
                                                            </td> <!-- Usage -->
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
                            <button type="submit" class="btn btn-dark rounded-10 shadoww pull-right">
                                <i class="fa fa-plus-circle mr-1"></i> Update
                            </button>
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
            $('#item_id').select2({
                theme: "bootstrap-5",
            });
        });
    </script>

@endsection
