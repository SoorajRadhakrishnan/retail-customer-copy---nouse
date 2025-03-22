@extends('Admin.theme')

@section('title', 'UNIT')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Units</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('unit_create') && getbranchid())
                                <button id="createbtn" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                data-pop="md" data-url="{{ url('admin/unit/create') }}?name=unit"
                                data-toggle="modal" data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                ><i class="fa fa-plus-circle mr-1"></i> Create</button>
                            @endif
                            {{-- <div class="dropdown">
                                <button class="btn btn-dark rounded-10 shadoww mr-2 mb-2 dropdown-toggled" type="button"
                                    id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-list"></i>
                                </button>
                                <ul class="dropdown-menu border-0 rounded-10" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-ite btn-block text-left btn btn-dark pt-2"
                                            href="../categories/active">View Active</a></li>
                                    <li><a class="dropdown-ite btn-block text-left btn btn-dark pt-2"
                                            href="../categories/hidden">View hidden</a></li>
                                </ul>
                            </div> --}}
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
                                                <th style="width: 15%">S.No</th>
                                                <th>Unit Name</th>
                                                @if ((checkUserPermission('unit_edit') || checkUserPermission('unit_delete')) && getbranchid())
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($units) > 0)
                                                @foreach ($units as $key => $unit)
                                                    <tr>
                                                        <td style="width: 15%">{{ $key + 1 }}</td>
                                                        <td>{{ Str::ucfirst($unit->unit_name) }}</td>
                                                        @if ((checkUserPermission('unit_edit') || checkUserPermission('unit_delete')) && getbranchid())
                                                            <td>
                                                                <div class="dropstart">
                                                                    <a class="dropdown-toggle text-dark" type="button"
                                                                        data-toggle="dropdown" aria-expanded="false">Actions</a>
                                                                    <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                        x-placement="bottom-end" style="font-size: 16px;">
                                                                        @if (checkUserPermission('unit_edit') && getbranchid())
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                                    data-pop="md"
                                                                                    data-url="{{ url('admin/unit/')."/".$unit->uuid."/edit" }}?name=unit"
                                                                                    data-toggle="modal"
                                                                                    data-target="#dynamicPopup-md"

                                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                                    >Edit</a>
                                                                            </li>
                                                                        @endif
                                                                        @if (checkUserPermission('unit_delete'))
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-0"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="deletemodel('{{ $unit->uuid }}','{{ $unit->unit_name }}','Delete unit','{{ url('admin/unit').'/'.$unit->uuid }}')">Delete</a>
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
