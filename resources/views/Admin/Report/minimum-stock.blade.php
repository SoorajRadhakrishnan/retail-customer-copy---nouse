@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? ' - ' . getBranchById(getSessionBranch()) : '';
$branch_name = auth()->user()->branch_id ? ' - ' . auth()->user()->branch->branch_name : $session_branch;
$title = 'MINIMUM STOCK REPORT' . $branch_name . ' - ' . $from_date . ' - ' . $to_date;
?>
@section('title', $title)

@section('style')

@endsection

@section('content')



    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Minimum Stock Report</h2>
                            <p class="az-dashboard-text"></p>
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
                                                <th>Item Name</th>
                                                <th>Minimum Stock</th>
                                                <th>Current Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($combinedData as $item)
                                            <tr>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->minimum_qty }}</td>
                                                <td>{{ $item->closing_stock ?? 'Not Added Yet' }}</td> <!-- Check if closing_stock exists -->
                                            </tr>
                                        @endforeach

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
