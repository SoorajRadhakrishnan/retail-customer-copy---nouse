@extends('Admin.theme')

@section('title', 'CATEGORY')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Categories</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('category_create') && getbranchid())
                                <button id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-pop="md"
                                    data-url="{{ url('admin/category/create') }}" data-toggle="modal"
                                    data-target="#dynamicPopup-md"
                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                        class="fa fa-plus-circle mr-1"></i> Create</button>
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
                            <button class="nav-linkk btn btn-dark rounded-10 shadow mr-2 mb-2"
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
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Category Name</th>
                                                <th>Other Name</th>
                                                @if ((checkUserPermission('category_edit') || checkUserPermission('category_delete')) && getbranchid())
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($categorys) > 0)
                                                @foreach ($categorys as $key => $category)
                                                    <tr>
                                                        <td style="width: 15%">{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($category->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ Str::ucfirst($category->category_name) }}</td>
                                                        <td>{{ Str::ucfirst($category->other_name) }}</td>
                                                        @if ((checkUserPermission('category_edit') || checkUserPermission('category_delete')) && getbranchid())
                                                            <td>
                                                                <div class="dropstart">
                                                                    <a class="dropdown-toggle text-dark" type="button"
                                                                        data-toggle="dropdown"
                                                                        aria-expanded="false">Actions</a>
                                                                    <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                        x-placement="bottom-end" style="font-size: 16px;">
                                                                        @if (checkUserPermission('category_edit'))
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                                    data-pop="md"
                                                                                    data-url="{{ url('admin/category/') . '/' . $category->uuid . '/edit' }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#dynamicPopup-md"

                                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                                >Edit</a>
                                                                            </li>
                                                                        @endif
                                                                        @if (checkUserPermission('category_delete'))
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-0"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="deletemodel('{{ $category->uuid }}','{{ $category->category_name }}','Delete Category','{{ url('admin/category') . '/' . $category->uuid }}')">Delete</a>
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

    <script>
        // $("#myPieChartDiv").html('<h4 class="py-5 my-5 text-center text-muted">NO SALES</h4>');
    </script>
    <script>
        // Sample data for the bar chart
        // var data = {
        //     labels: ['Dec 23', 'Jan 24', 'Mar 24', 'Mar 24', 'Apr 24', 'May 24', ],
        //     datasets: [{
        //         label: 'BRANCHONE',
        //         data: [, 14700.00, , , , , ],
        //         backgroundColor: [
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //         ],
        //         borderColor: [
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //         ],
        //         borderWidth: 1
        //     }]
        // };

        // Get the context of the canvas element
        // var ctx = document.getElementById('myBarChart').getContext('2d');

        // Create the bar chart
        // var myBarChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: data,
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //         // You can add additional options here
        //     }
        // });


        // var data2 = {
        //     labels: ['Dec 23', 'Jan 24', 'Mar 24', 'Mar 24', 'Apr 24', 'May 24', ],
        //     datasets: [{
        //         label: 'BRANCHONE',
        //         data: [, 500.00, , , , , ],
        //         backgroundColor: [
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //         ],
        //         borderColor: [
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //             'rgba(59, 72, 99, 0.7)',
        //         ],
        //         borderWidth: 1
        //     }]
        // };
        // Get the context of the canvas element
        // var ctx = document.getElementById('myBarChart2').getContext('2d');

        // // Create the bar chart
        // var myBarChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: data2,
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //         // You can add additional options here
        //     }
        // });
    </script>


    {{-- <script type="text/javascript">
        var colors = ['#3b4863', '#28a745', '#EC5FE7', "#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"];
        var chLine = document.getElementById("chLine");
        var chartData = {
            labels: [],
            datasets: [{
                label: 'BRANCHONE',
                data: [],
                borderColor: colors[0],
                borderWidth: 4,
                pointBackgroundColor: colors[0]
            }, ]
        };
        if (chLine) {
            new Chart(chLine, {
                type: 'line',
                data: chartData,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: true
                    }
                }
            });
        }
    </script> --}}

@endsection
