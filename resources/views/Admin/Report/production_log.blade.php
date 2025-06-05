@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? ' - ' . getBranchById(getSessionBranch()) : '';
$branch_name = auth()->user()->branch_id ? ' - ' . auth()->user()->branch->branch_name : $session_branch;
$title = 'PRODUCTION LOG' . $branch_name . ' - ' . $from_date . ' - ' . $to_date;

?>
@section('title', $title)

@section('style')

@endsection

@section('content')


    <?php

    $item = isset($_GET['item_id']) && $_GET['item_id'] != '' ? $_GET['item_id'] : '';

    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Production Log</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row d-flex flex-wrap">
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
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Item</label>
                                        <select class="form-control rounded-10 select2" id="item_id" name="item_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select Item</option>
                                            @foreach ($items as $item_id)
                                                <?php
                                                if ($item_id->size_name === 'Unit price') {
                                                    $item_id->size_name = '';
                                                }
                                                ?>
                                                <option value="{{ $item_id->price_id }}"
                                                    @if ($item_id->price_id == $item) selected="selected" @endif>
                                                    {{ Str::ucfirst($item_id->item_name) }}{{ $item_id->size_name ? ' - ' . $item_id->size_name : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                        <button type="submit" class="btn btn-dark rounded-10 px-3">
                                            Submit
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
                                    {{-- <div class="dt-buttons">
                                        <a href="{{ url('admin/item-wise-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&item={{ $item }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/item-wise-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&item={{ $item }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
                                            aria-controls="example" type="button"><span><i class="fa fa-file-pdf-o"
                                                    style="font-size:1.2rem"></i></span>
                                        </a>
                                    </div> --}}
                                                                        <table id="example" class="table table-hover table-custom border-bottom-0" style="width: 100%" >
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>unit Production cost</th>
                                                <th>Production Cost</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ getBranchById($value->shop_id) }}</td>
                                                        @endif
                                                        @if ($value->price_id)
                                                        <td>{{ Str::ucfirst(getItemNameSize($value->price_id)) }}
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        @endif
                                                        <td>{{ $value->qty }}</td>
                                                        <td>{{ showAmount($value->unit_cost_price) }}</td>
                                                        <td>{{ showAmount($value->production_cost)}}</td>
                                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
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
            $('#item_id').select2({
                theme: "bootstrap-5",
            });
        });
    </script>

@endsection
