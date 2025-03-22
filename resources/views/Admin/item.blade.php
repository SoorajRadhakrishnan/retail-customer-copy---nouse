@extends('Admin.theme')

@section('title', 'ITEM')

@section('style')

    <style>
        .imageHover::hove {
            cursor: pointer;
        }
    </style>

@endsection

@section('content')
    <?php
    $getBranch = getbranchid();
    $item_edit = checkUserPermission('item_edit');
    $item_delete = checkUserPermission('item_delete');

    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Item</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('item_create') && $getBranch)
                                <button id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-pop="lg"
                                    data-url="{{ url('admin/item/create') }}" data-toggle="modal"
                                    data-target="#dynamicPopup-lg" data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                        class="fa fa-plus-circle mr-1"></i> Create</button>

                                <!-- New Excel Upload Button -->
                                {{-- <button id="uploadExcelBtn" class="nav-linkk btn btn-success rounded-10 shadoww mr-2 mb-2"
                                data-toggle="modal" data-target="#uploadExcelModal">
                                <i class="fa fa-file-excel-o mr-1"></i> Upload via Excel
                            </button> --}}
                            @endif

                        </nav>
                    </div>
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Category</label>
                                        <select class="form-control rounded-10 select2" name="category_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id == $category_id) selected="selected" @endif>
                                                    {{ Str::ucfirst($category->category_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Item Type</label>
                                        <select class="form-control rounded-10 select2" name="item_type"
                                            onchange="this.form.submit()">
                                            @foreach ($itemTypes as $value => $label)
                                                <option value="{{ $value }}"
                                                    @if ($value == $item_type) selected="selected" @endif>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Item</label>
                                        <select class="form-control rounded-10 select2" id="item_id" name="item_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select Item</option>
                                            @foreach ($itemList as $value)
                                                <option value="{{ $value->item_id }}"
                                                    @if ($value->item_id == $item_id) selected="selected" @endif>
                                                    {{ Str::ucfirst($value->item_name) }}
                                                    {{ $value->size_name === 'Unit price' ? '' : ' - ' . $value->size_name }}
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

                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    <table id="example" class="table table-hover table-custom border-bottom-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Item Name</th>
                                                <th width="10%">Item Other Name</th>
                                                <th>Item Category</th>
                                                <th>Item Unit</th>
                                                {{-- <th>Cost Price</th>
                                                <th>Selling Price</th> --}}
                                                {{-- <th>Cost Price</th> --}}
                                                {{-- <th>Selling Price</th> --}}
                                                <th>Item Type</th>
                                                <th width="10%">Stock Applicable</th>
                                                <th>Image</th>
                                                @if (($item_edit || $item_delete) && $getBranch)
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($items) > 0)

                                                {{-- @dd($items) --}}
                                                @foreach ($items as $key => $item)
                                                    <tr>
                                                        <td width="5%">{{ $key + 1 }}</td>

                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($item->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ Str::ucfirst($item->item_name) }}</td>
                                                        <td width="10%">{{ Str::ucfirst($item->item_other_name) }}</td>
                                                        <td>{{ Str::ucfirst($item->category->category_name) }}</td>
                                                        <td>{{ Str::ucfirst($item->unit->unit_name) }}</td>
                                                        {{-- <td>{{ Str::ucfirst($item->item_cost_price) }}</td>
                                                        <td>{{ $item->item_price }}</td> --}}
                                                        {{-- <td>{{  $item->barcode }}</td> --}}
                                                        <td width="10%">
                                                            @if ($item->item_type == '1')
                                                                Salable
                                                            @elseif ($item->item_type == '0')
                                                                Non-Salable
                                                            @else
                                                                Raw Material
                                                            @endif
                                                        </td>
                                                        </td>
                                                        <td>
                                                            @if ($item->stock_applicable == '1')
                                                                Yes
                                                            @else
                                                                No
                                                            @endif
                                                        </td>
                                                        @if ($item->image)
                                                            <td><a href="{{ url('storage/item_image') . '/' . optional($item)->image }}"
                                                                    target="_blank"><img
                                                                        src="{{ url('storage/item_image') . '/' . optional($item)->image }}"
                                                                        class="rounded-10 mt-1 " id="img1"
                                                                        width="50px;" height="50px;"
                                                                        onerror="this.onerror=null;this.src='{{ url('assets/img/error-image.webp ') }}';"></a>
                                                            </td>
                                                        @else
                                                            <td>{{ $item->image }}</td>
                                                        @endif
                                                        @if (($item_edit || $item_delete) && $getBranch)
                                                            <td>
                                                                <div class="dropstart">
                                                                    <a class="dropdown-toggle text-dark" type="button"
                                                                        data-toggle="dropdown"
                                                                        aria-expanded="false">Actions</a>
                                                                    <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                        x-placement="bottom-end" style="font-size: 16px;">
                                                                        @if ($item_edit && $getBranch)
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                                    data-pop="lg"
                                                                                    data-url="{{ url('admin/item/') . '/' . $item->uuid . '/edit' }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#dynamicPopup-lg"
                                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}">Edit</a>
                                                                            </li>
                                                                        @endif
                                                                        @if ($item_delete)
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-0"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="deletemodel('{{ $item->uuid }}','{{ $item->item_name }}','Delete item','{{ url('admin/item') . '/' . $item->uuid }}')">Delete</a>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        @endif
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
    <div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog" aria-labelledby="uploadExcelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ url('admin/item/upload-excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadExcelModalLabel">Upload Items via Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="excel_file">Select Excel File</label>
                            <input type="file" class="form-control" name="excel_file" accept=".xls,.xlsx" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
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
