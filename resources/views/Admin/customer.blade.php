@extends('Admin.theme')

@section('title', 'CUSTOMER')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Customer</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('customer_create') && getbranchid())
                                <button id="createbtn" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                data-pop="md" data-url="{{ url('admin/customer/create') }}"
                                data-toggle="modal" data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                ><i class="fa fa-plus-circle mr-1"></i> Create</button>
                            @endif

                            <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2"
                                onclick="window.location.reload()" title="click to reload this page"><i class="fa fa-refresh mr-1"></i></i>Reload</button>
                            <a class="nav-link rounded-10 mr-2 d-none" href="#"><i class="fas fa-ellipsis-h"></i></a>
                        </nav>
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
                                                <th style="width: 10%">S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>customer Name</th>
                                                <th>customer Email</th>
                                                <th>customer Number</th>
                                                <th>customer Address</th>
                                                <th>customer Gender</th>
                                                @if ((checkUserPermission('customer_edit') || checkUserPermission('customer_delete')) && getbranchid())
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($customers) > 0)
                                                @foreach ($customers as $key => $customer)
                                                    <tr>
                                                        <td style="width: 10%">{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($customer->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{  Str::ucfirst($customer->customer_name) }}</td>
                                                        <td>{{  $customer->customer_email }}</td>
                                                        <td>{{  $customer->customer_number }}</td>
                                                        <td>{{  Str::ucfirst($customer->customer_address) }}</td>
                                                        <td>{{  Str::ucfirst($customer->customer_gender) }}</td>
                                                        @if ((checkUserPermission('customer_edit') || checkUserPermission('customer_delete')) && getbranchid())
                                                            <td>
                                                                <div class="dropstart">
                                                                    <a class="dropdown-toggle text-dark" type="button"
                                                                        data-toggle="dropdown" aria-expanded="false">Actions</a>
                                                                    <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                        x-placement="bottom-end" style="font-size: 16px;">
                                                                        @if (checkUserPermission('customer_edit') && getbranchid())
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                                    data-pop="md"
                                                                                    data-url="{{ url('admin/customer/')."/".$customer->uuid."/edit" }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#dynamicPopup-md"

                                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                                    >Edit</a>
                                                                            </li>
                                                                        @endif
                                                                        @if (checkUserPermission('customer_delete'))
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-0"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="deletemodel('{{ $customer->uuid }}','{{ $customer->customer_name }}','Delete customer','{{ url('admin/customer').'/'.$customer->uuid }}')">Delete</a>
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

@endsection

@section('script')

@endsection
