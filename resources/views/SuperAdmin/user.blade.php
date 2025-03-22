@extends('SuperAdmin.Layout.theme')

@section('title', 'USERS')

@section('style')

@endsection

@section('content')

    @section('back_url', url('settings'))

    @include('SuperAdmin.Layout.header')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Users</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            <a href="{{ url('user-permission') }}"
                                class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2"><i
                                    class="fa fa-plus-circle mr-1"></i> Create</a>
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
                                onclick="window.location.reload()" title="click to reload this page">Submit</button>
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
                                                <th>S.No</th>
                                                <th>Username</th>
                                                <th>User Type</th>
                                                <th>Branch</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($users) > 0)
                                                @foreach ($users as $key => $user)
                                                    <tr>
                                                        <td>{{ ($key+1) }}</td>
                                                        <td>{{ Str::ucfirst($user->name) }}</td>
                                                        <td>{{ $user->usertype }}</td>
                                                        @if ($user->branch)
                                                            <td>{{ $user->branch->branch_name }}</td>
                                                        @else
                                                            <td> -- </td>
                                                        @endif
                                                        <td>
                                                            <div class="dropstart">
                                                                <a class="dropdown-toggle text-dark" type="button"
                                                                    data-toggle="dropdown"
                                                                    aria-expanded="false">Actions</a>
                                                                <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                    x-placement="bottom-end" style="font-size: 16px;">
                                                                    <li>
                                                                        <a class="dropdown-item rounded-0 border-bottom"
                                                                            href="{{ url('user-permission') . '/' . $user->uuid }}">Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item rounded-0 border-0"
                                                                            href="javascript:void(0)"
                                                                            onclick="deletemodel('{{ $user->uuid }}','{{ $user->name }}')">Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- <tr>
                                                    <td>No User Record</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr> --}}
                                            @endif
                                        </tbody>
                                        {{-- <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="row"> --}}
                {{-- <div class="col-12">
                            <div class="card rounded-10 shadow"> --}}
                {{-- <div class="card-header  border-bottom border-secondary">
                                    <div class="mb-3 mt-3">
                                        <span class="az-dashboard-title" style="padding: 0px 10px 0px 0px;">Users</span>
                                        <a href="{{ url('user-permission') }}"
                                            class="nav-linkk btn btn-dark rounded-10 shadoww"
                                            title="click to Create new user"><i
                                                class="fa fa-plus-circle mr-1"></i> Create</a>
                                        <button class="nav-linkk btn btn-dark rounded-10 shadoww"
                                            onclick="window.location.reload()"
                                            title="click to reload this page"><i
                                                class="fa fa-refresh mr-0"></i>
                                        </button>
                                    </div>
                                </div> --}}
                {{-- <div class="card-body overflow-auto">
                                    <table id="datatable" class="table table-hover table-stripedd table-custom display"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>User Type</th>
                                                <th>Branchs</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 16px;">
                                            @if (count($users) > 0)
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ Str::ucfirst($user->name) }}</td>
                                                        <td>{{ $user->usertype }}</td>
                                                        <td>{{ $user->usertype }}</td>
                                                        <td>
                                                            <div class="dropstart">
                                                                <a class="dropdown-toggle text-dark" type="button"
                                                                    data-toggle="dropdown"
                                                                    aria-expanded="false">Actions</a>
                                                                <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                    x-placement="bottom-end" style="font-size: 16px;">
                                                                    <li>
                                                                        <a class="dropdown-item rounded-0 border-bottom"
                                                                            href="{{ url('user-permission') . '/' . $user->uuid }}">Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item rounded-0 border-0"
                                                                            href="javascript:void(0)"
                                                                            onclick="deletemodel('{{ $user->uuid }}','{{ $user->name }}')">Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" style="text-align:center">No User Record</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div> --}}
                {{-- </div>
                        </div> --}}
                {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade show" id="dynamicPopup-md" role="dialog"
        style="padding-left: 17px;">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Delete User</h5>
                </div>
                <form action="POST" id="delete-user" class="was-validated" autocomplete="off">
                    @csrf
                    <input type="hidden" name="uuid" id="uuid" value="">
                    <div class="col-12 p-0">
                        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Are you sure you want to delete <span
                                                id="username"></span> user..!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                                data-dismiss="modal">Cancel</button>
                            {{-- <button type="submit"
                                class="btn btn-dark px-4 text-uppercase rounded-10 delete_user">Delete</button> --}}
                                <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                    data-method="newbranch" data-form="delete-user" data-target="{{ url('delete-user') }}"
                                    data-returnaction="reload" data-processing="Please wait, saving..."
                                    data-image="{{ url(config('constant.LOADING_GIF')) }}">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        function deletemodel(id, name) {
            // $('.delete_user').attr('data-id', id);
            $('#uuid').val(id);
            $('#username').text(name);
            $('#dynamicPopup-md').modal('show');
        }

        // $('.delete_user').on('click', function() {
        //     var id = $(this).data('id');
        //     $.ajax({
        //         url: 'delete-user',
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             "uuid": id
        //         },
        //         type: 'post',
        //         dataType: "json",
        //         success: function(response) {
        //             if (response.message == 'success') {
        //                 // alert(response.url);
        //                 //notifyme2("Deleted successfullys");
        //                 window.location.href = "{{ url('users') }}";
        //             } else {
        //                 window.location.href = "{{ url('users') }}";
        //             }
        //         }
        //     });
        // });

        $('#example').dataTable({
            "language": {
                "emptyTable": "No User found"
            }
        });
    </script>

@endsection
