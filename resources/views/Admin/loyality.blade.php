@extends('Admin.theme')

@section('title', 'LOYALTY')

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
                        <h2 class="az-dashboard-title">Loyalty Points</h2>
                        <p class="az-dashboard-text"></p>
                    </div>
                    <div class="az-content-header-right">
                    </div>
                </div>
            </div>
            <div class="az-dashboard-nav border-0">
                <nav class="nav">
                    @if (checkUserPermission('customer_create') && getbranchid())
                        <button id="createbtn" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                        data-pop="md" data-url="{{ url('admin/loyalty/create') }}"
                        data-toggle="modal" data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                        ><i class="fa fa-plus-circle mr-1"></i> Update</button>
                    @endif

                </nav>
            </div>

            <div class="col-12 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card rounded-10 shadow">
                            <div class="card-body overflow-auto">
                                {{-- <div class="dt-buttons">
                                    <a href="{{ url('admin/customer-wise-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&customer_id={{ $customer_id }}"
                                        class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                        tabindex="0" aria-controls="example" type="button"><span><i
                                                class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                    </a>
                                    <a href="{{ url('admin/customer-wise-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&customer_id={{ $customer_id }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
                                        aria-controls="example" type="button"><span><i class="fa fa-file-pdf-o"
                                                style="font-size:1.2rem"></i></span>
                                    </a>
                                </div> --}}
                                <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            @if (!auth()->user()->branch_id)
                                                <th>Branch</th>
                                            @endif
                                            <th>Minimum sale amount</th>
                                            <th>loyalty points</th>
                                            <th>loyalty selling points</th>
                                            <th>redeem amount</th>
                                        </tr>
                                    </thead>
                                    <?php $total_amount = $total_without_discount = $total_discount = $total_counts = 0;?>
                                    <tbody>
                                        @if ($loyalty)
                                            <tr>
                                                <td>1</td> <!-- Static row number since it's a single record -->
                                                @if (!auth()->user()->branch_id)
                                                    <td>N/A</td> <!-- Replace with branch logic if applicable -->
                                                @endif
                                                <td>{{ $loyalty->min_sale_amount }}</td>
                                                <td>{{ $loyalty->loyalty_points }}</td>
                                                <td>{{ $loyalty->selling_points }}</td>
                                                <td>{{ $loyalty->redeem_amount }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">No loyalty data available.</td>
                                            </tr>
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
@endsection
