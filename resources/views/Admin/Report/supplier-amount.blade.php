@extends('Admin.theme')
<?php

$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'SUPPLIER-OUTSTANDING'.$branch_name;

?>
@section('title',$title)

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-9">
                        <div class="az-dashboard-one-title">
                            <div>
                                <h2 class="az-dashboard-title">Supplier - Outstanding Report</h2>
                            </div>
                            <div class="az-content-header-right">
                            </div>
                        </div>
                        <div class="card rounded-10 shadow">
                            <div class="card-body overflow-auto">
                                <table id="example" class="table table-custom"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            @if (!auth()->user()->branch_id)
                                                <th>Branch</th>
                                            @endif
                                            <th>Supplier </th>
                                            <th>Outstanding</th>
                                        </tr>
                                    </thead>
                                    <?php $total_amount = 0; ?>
                                    <tbody>
                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td>{{ ($key+1) }}</td>
                                                    @if (!auth()->user()->branch_id)
                                                        <td>{{ getBranchById($value->shop_id) }}</td>
                                                    @endif
                                                    <td class="sorting_1 dtr-control">
                                                        <a href="javascript:void(0)" class="text-dark d-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ getSupplierById($value->supplier_id) }}
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item rounded-0"
                                                                href="{{ route('purchase.index', [
                                                                    'supplier' => $value->supplier_id,
                                                                    'shop_id' => $value->shop_id,
                                                                    'payment_status' => 'pending',
                                                                    'from_date' => $value->date_added, // Pass oldest date as from_date
                                                                    'to_date' => request('to_date'),
                                                                ]) }}">
                                                                Purchase report
                                                            </a>

                                                            </li>
                                                        </div>
                                                    </td>
                                                    <td>{{ showAmount($value->total_pending) }}</td>
                                                </tr>
                                                <?php
                                                    $total_amount += $value->total_pending;
                                                ?>
                                            @endforeach
                                        @endif
                                    </tbody>
                                                                                                                                                                                                                        <tfoot>
                                        <tr>
                                            <td></td>
                                            @if (!auth()->user()->branch_id)
                                                <td></td>
                                            @endif
                                            <td  class="font-weight-bold">Total Outstanding Amount</td>
                                            <td class="font-weight-bold">{{ showAmount($total_amount,1) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
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
            $('#customer_id').select2({
                theme: "bootstrap-5",
            });
        });
    </script>

@endsection
