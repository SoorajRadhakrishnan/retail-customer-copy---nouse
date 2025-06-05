@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'REDEEM HISTORY'.$branch_name.' - '.$from_date." - ".$to_date;

?>
@section('title',$title)

@section('style')

@endsection

@section('content')


<?php

$customer_id = (isset($_GET['customer_id']) && $_GET['customer_id'] != '') ? $_GET['customer_id'] : '';

?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Redeem History</h2>
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
                                        <input type="date" value="{{ $startDate }}" name="start_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                        <input type="date" value="{{ $endDate }}" name="end_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>

                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Customers</label>
                                        <select class="form-control rounded-10 select2" id="customer_id" name="customer_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if ($customer->id == $customer_id) selected="selected" @endif>
                                                    {{ $customer->customer_name.' - '.$customer->customer_number }}
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
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Receipt ID</th>

                                                {{-- Show "Points Redeemed" column only if there are records with points_redeemed > 0 --}}
                                                    <th>Points Redeemed</th>
                                                {{-- Show "Referred Code" column only if there are records with a non-empty referred_code --}}

                                                <th>Discount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($pointsHistory) > 0)
                                                @foreach ($pointsHistory as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ getBranchById($value->shop_id) }}</td>
                                                        @endif
                                                        <td>{{dateFormat($value->created_at)}}</td>
                                                        <td>{{ Str::ucfirst(getCustomerDetById($value->customer_id)) }}</td>
                                                        <td>{{ $value->receipt_id }}</td>

                                                        {{-- Show "Points Redeemed" value only if points_redeemed > 0 --}}
                                                            <td>{{ $value->points_redeemed }}</td>



                                                        <td>{{ showAmount($value->discount) }}</td>
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
        $('#customer_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>

@endsection
