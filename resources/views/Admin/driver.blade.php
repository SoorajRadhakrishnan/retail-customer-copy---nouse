@extends('Admin.theme')

@section('title', 'DRIVER')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Driver</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('driver_create') && getbranchid())
                                <button id="createbtn" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                data-pop="md" data-url="{{ url('admin/driver/create') }}"
                                data-toggle="modal" data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                ><i class="fa fa-plus-circle mr-1"></i> Create</button>
                            @endif

                            <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2"
                                onclick="window.location.reload()" title="click to reload this page"><i class="fa fa-refresh mr-2"></i>Reload</button>
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
                                                <th>Driver Name</th>
                                                <th>Driver Email</th>
                                                <th>Driver Number</th>
                                                <th>Driver Address</th>
                                                <th>Date Of Join</th>
                                                <th>Driver Code</th>
                                                <th>Driver Pin</th>
                                                <th>Driver License</th>
                                                @if ((checkUserPermission('driver_edit') || checkUserPermission('driver_delete')) && getbranchid())
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($drivers) > 0)
                                                @foreach ($drivers as $key => $driver)
                                                    <tr>
                                                        <td style="width: 10%">{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($driver->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{  Str::ucfirst($driver->driver_name) }}</td>
                                                        <td>{{  $driver->driver_email }}</td>
                                                        <td>{{  $driver->driver_phone }}</td>
                                                        <td>{{  Str::ucfirst($driver->driver_address) }}</td>
                                                        <td>{{  dateFormat($driver->date_of_join) }}</td>
                                                        <td>{{  $driver->driver_code }}</td>
                                                        <td>{{  $driver->driver_pin }}</td>
                                                        @if ($driver->driver_license)
                                                            <td><a href="{{ url('storage/driver_license')."/".optional($driver)->driver_license }}" target="_blank"><img src="{{ url('storage/driver_license')."/".optional($driver)->driver_license }}" class="rounded-10 mt-1 "
                                                                id="img1" width="100px;"></a></td>
                                                        @else
                                                            <td>{{  $driver->driver_license }}</td>
                                                        @endif
                                                        @if ((checkUserPermission('driver_edit') || checkUserPermission('driver_delete')) && getbranchid())
                                                            <td>
                                                                <div class="dropstart">
                                                                    <a class="dropdown-toggle text-dark" type="button"
                                                                        data-toggle="dropdown" aria-expanded="false">Actions</a>
                                                                    <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                        x-placement="bottom-end" style="font-size: 16px;">
                                                                        @if (checkUserPermission('driver_edit') && getbranchid())
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                                    data-pop="md"
                                                                                    data-url="{{ url('admin/driver/')."/".$driver->uuid."/edit" }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#dynamicPopup-md"

                                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                                    >Edit</a>
                                                                            </li>
                                                                        @endif
                                                                        @if (checkUserPermission('driver_delete'))
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-0"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="deletemodel('{{ $driver->uuid }}','{{ $driver->driver_name }}','Delete Driver','{{ url('admin/driver').'/'.$driver->uuid }}')">Delete</a>
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
