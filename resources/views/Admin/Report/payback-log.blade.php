@extends('Admin.theme')

<?php
$from_date = request()->get('from_date') ?? date('Y-m-d');
$to_date = request()->get('to_date') ?? date('Y-m-d');
$session_branch = getSessionBranch() ? ' - ' . getBranchById(getSessionBranch()) : '';
$branch_name = auth()->user()->branch_id ? ' - ' . auth()->user()->branch->branch_name : $session_branch;
$title = 'PAY BACK LOG' . $branch_name . ' - ' . $from_date . ' - ' . $to_date;
?>
@section('title', $title)

@section('style')
@endsection

@section('content')

    <?php
    $customer_id = request()->get('customer_id') ?? '';
    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Pay Back log</h2>
                            <p class="az-dashboard-text"></p>
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
                                        <label class="mb-0 d-block small font-weight-bold">Customers</label>
                                        <select class="form-control rounded-10 select2" id="customer_id" name="customer_id" onchange="this.form.submit()">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->customer_id }}" {{ $customer->customer_id == $customer_id ? 'selected' : '' }}>
                                                    {{ $customer->customer_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                        <button type="submit" class="btn btn-dark rounded-10 px-3">Submit</button>
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
                                    <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Receipt ID</th>
                                                {{-- <th>Customer Name </th> --}}
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Net Total</th>
                                                <th>Tax Amount</th>
                                                <th>Payment Type</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tbody>@php
                                                    $total_amount = $total_without_discount = $total_discount = $total_qty = 0;
                                                @endphp
                                            @if ( count($paybacks) > 0)
                                                
                                                @foreach ($paybacks as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ $value->shop_id ? Str::ucfirst(getBranchById($value->shop_id)) : 'Unknown Branch' }}</td>
                                                        @endif
                                                        <td>{{ $value->receipt_id }}</td>
                                                        {{-- <td>{{ $value->customer_name }}</td> --}}
                                                        <td>{{ $value->item_name }}</td>
                                                        <td>{{ $value->qty }}</td>
                                                        <td>{{ showAmount($value->amount) }}</td>
                                                        <td>{{ showAmount($value->discount) }}</td>
                                                        <td>{{ showAmount($value->amount - $value->discount) }}</td>
                                                        <td>{{ showAmount($value->tax_amt) }}</td>
                                                        <td>{{ Str::ucfirst($value->payment_type) }}</td>
                                                        <td>{{ $value->user_name }}</td>
                                                        
                                                        @php
                                                            $total_amount += $value->amount;
                                                            $total_discount += $value->discount;
                                                            $total_without_discount += $value->amount - $value->discount;
                                                        @endphp
                                                    </tr>
                                                @endforeach
                                            
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                @if (!auth()->user()->branch_id)
                                                    <td></td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ showAmount($total_amount, 1) }}</td>
                                                <td>{{ showAmount($total_discount, 1) }}</td>
                                                <td>{{ showAmount($total_without_discount, 1) }}</td>
                                                <td></td>
                                                <td></td>
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
