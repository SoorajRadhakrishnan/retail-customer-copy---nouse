@extends('Admin.theme')

@section('title', 'OFFERS')

@section('style')

@endsection

@section('content')

    <?php

    $from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
    $to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');

    ?>
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Offers</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            {{-- @if (checkUserPermission('offer_create') && getbranchid()) --}}
                                <button id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-pop="md"
                                    data-url="{{ url('admin/offers/create') }}" data-toggle="modal"
                                    data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                        class="fa fa-plus-circle mr-1"></i> Create</button>
                            {{-- @endif --}}
                        </nav>
                    </div>
                    {{-- <div class="col-12"> --}}
                        <div class="card rounded-10 shadow">
                            <div class="card-header">
                                <form>
                                    <div class="row">
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                            <input type="date" value="{{ $from_date }}" name="from_date"
                                                class="form-control rounded-10" required onchange="this.form.submit()">
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                            <input type="date" value="{{ $to_date }}" name="to_date"
                                                class="form-control rounded-10" required onchange="this.form.submit()">
                                        </div>

                                        <div class="w-auto ml-3 ">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">
                                                Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    <table id="example1" class="table table-hover table-custom border-bottom-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">S.No</th>
                                                {{-- @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif --}}
                                                <th>Offer name</th>
                                                {{-- <th>Promo Code</th> --}}
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Amount Type</th>
                                                <th>Value</th>
                                                {{-- <th>Active</th> --}}
                                                {{-- @if ((checkUserPermission('expense_edit') || checkUserPermission('expense_delete')) && getbranchid()) --}}
                                                {{-- @endif --}}
                                                {{-- <th>Categories</th> --}}
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                       <tbody>
                                        {{-- @dd($offers) --}}
                                                @if (count($offers) > 0)
                                                    @foreach ($offers as $key => $offer)
                                                        <tr>
                                                            <td style="width: 5%">{{ $key + 1 }}</td>
                                                            {{-- @if (!auth()->user()->branch_id)
                                                                <td>{{ Str::ucfirst($offer->branch->branch_name) }}</td>
                                                            @endif --}}
                                                            <td>{{ Str::ucfirst($offer->offer_name) }}</td>
                                                            {{-- <td>{{ Str::ucfirst($offer->promocode) }}</td> --}}
                                                            <td>{{ Str::ucfirst($offer->from_date) }}</td>
                                                            <td>{{ Str::ucfirst($offer->to_date) }}</td>
                                                            <td>{{ Str::ucfirst($offer->type) }}</td>
                                                            <td>{{ showAmount($offer->value) }}</td>
                                                            {{-- <td>{{ showAmount($offer->active) }}</td> --}}
                                                            {{-- @if ((checkUserPermission('offer_edit') || checkUserPermission('offer_delete')) && getbranchid()) --}}
                                                            {{-- <td>
                                                                <div class="btn-group rounded-10" role="group" aria-label="Basic example" data-bs-toggle="tooltip"
                                                                     data-bs-placement="top" title="Categories">
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                       data-pop="md"
                                                                       data-url="{{ url('admin/offers/') . '/' . $offer->uuid }}"
                                                                       data-toggle="modal" data-target="#dynamicPopup-md"
                                                                       data-image="{{ url(config('constant.LOADING_GIF')) }}">
                                                                        <i class="fa fa-list"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
 --}}
                                                            <td>
                                                                    <div class="dropstart">
                                                                        <a class="dropdown-toggle text-dark" type="button"
                                                                            data-toggle="dropdown"
                                                                            aria-expanded="false">Actions</a>
                                                                        <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                            x-placement="bottom-end" style="font-size: 16px;">
                                                                            {{-- @if (checkUserPermission('offer_edit')) --}}
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                                    data-pop="md"
                                                                                    data-url="{{ url('admin/offers/') . '/' . $offer->uuid . '/edit' }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#dynamicPopup-md"

                                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                                >Edit</a>
                                                                            </li>

                                                                            {{-- @endif --}}
                                                                            {{-- @if (checkUserPermission('offer_delete')) --}}
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-0"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="deletemodel('{{ $offer->uuid }}','{{ $offer->offer_name }}','Delete Offer','{{ url('admin/offers') . '/' . $offer ->uuid }}')">Delete</a>
                                                                            </li>
                                                                            {{-- @endif --}}
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            {{-- @endif --}}
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


        </script>

@endsection
