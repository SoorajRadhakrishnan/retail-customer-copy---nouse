@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'PROFIT LOSS'.$branch_name.' - '.$from_date." - ".$to_date;

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
                                <h2 class="az-dashboard-title">Profit Loss Report</h2>
                            </div>
                            <div class="az-content-header-right">
                            </div>
                        </div>
                        <div class="card rounded-10 shadow my-3">
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
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">
Submit                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card rounded-10 shadow">
                            <div class="card-body overflow-auto">
                                <table id="example" class="table table-custom" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Discription</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <?php $total_amount = 0; ?>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sale</td>
                                            <td>{{ showAmount(optional($sale)->total_amount,1) }}</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Purchase</td>
                                            <td>{{ showAmount(optional($purchase)->total_amount,1) }}</td>
                                        </tr>
                                        {{-- <tr>
                                           <td>3</td>
                                            <td>Production</td>
                                            <td>{{ showAmount(optional($production)->total_amount,1) }}</td>

                                        </tr>--}}
                                        <tr>
                                            <td>4</td>
                                            <td>Expense</td>
                                            <td>{{ showAmount(optional($expense)->total_amount,1) }}</td>
                                        </tr>
                                    </tbody>
                                    <?php
                                        $balance = optional($sale)->total_amount - (optional($purchase)->total_amount + optional($expense)->total_amount);
                                        $style = $balance >= 0 ?  "color:green" : "color:red";
                                    ?>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>Profit</td>
                                            <td style="{{ $style }}">
                                                {{ showAmount($balance,1) }}
                                            </td>
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
