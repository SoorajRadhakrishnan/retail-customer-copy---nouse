@extends('SuperAdmin.Layout.theme')

@section('title', 'MAIN SETTING')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="d-flex justify-content-center mt-5">
                    <img src="{{ url('assets/img/zaadDocs.png') }}"
                        class="d-none d-md-block animate__animated animate__rubberBand">
                    <img src="{{ url('assets/img/zaadDocs-m.png') }}"
                        class="d-block d-md-none animate__animated animate__rubberBand" style="width: 130px;">
                </div>
                <p class="text-center small animate__animated animate__rubberBand">Settings</p>
                <div class="col-12 mt-4 px-0">
                    <div class="d-flex justify-content-center">
                        <div class="col-xl-6 p-0">
                            <div class="card rounded-10 mt-3 shadow animate__animated animate__fadeInUp">
                                <div class="card-body overflow-auto">
                                    <h5 class="mb-0">Software Settings</h5>
                                    <p></p>
                                    <ul class="list-group rounded-10-2">
                                        <li class="list-group-item p-1 rounded-10-2 border">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <th style="vertical-align: middle;" class="p-0">
                                                        <h5 class="mb-0 pl-3">Software Settings</h5>
                                                    </th>
                                                    <td class="text-right" class="p-0">
                                                        <a class="btn btn-outline-dark rounded-10"
                                                            href="{{ url('software-settings') }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                        <li class="list-group-item p-1 rounded-10-2 border mt-2">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <th style="vertical-align: middle;" class="p-0">
                                                        <h5 class="mb-0 pl-3">Payment Method</h5>
                                                    </th>
                                                    <td class="text-right" class="p-0">
                                                        <a class="btn btn-outline-dark rounded-10"
                                                            href="{{ url('payment-method') }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                        <li class="list-group-item p-1 rounded-10-2 border mt-2">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <th style="vertical-align: middle;" class="p-0">
                                                        <h5 class="mb-0 pl-3">Payment size</h5>
                                                    </th>
                                                    <td class="text-right" class="p-0">
                                                        <a class="btn btn-outline-dark rounded-10"
                                                            href="{{ url('price-size') }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card rounded-10 mt-3 shadow animate__animated animate__fadeInUp">
                                <div class="card-body overflow-auto">
                                    <h5 class="mb-0">Branches</h5>
                                    <p></p>
                                    <ul class="list-group rounded-10-2">
                                        @if (count($branches) > 0)

                                            @foreach ($branches as $branch)
                                                <li class="list-group-item p-1 rounded-10-2 border mt-2">
                                                    <table class="table table-borderless mb-0">
                                                        <tr>
                                                            <th style="vertical-align: middle;" class="p-0">
                                                                <h5 class="mb-0 pl-3">
                                                                    {{ Str::ucfirst($branch->branch_name) . ' | ' . Str::ucfirst($branch->location) }}
                                                                </h5>
                                                            </th>
                                                            <td class="text-right" class="p-0">
                                                                <a class="btn btn-outline-dark rounded-10 dynamicPopup"
                                                                    href="javascript:void(0)" data-pop="lg"
                                                                    data-url="{{ url('branch') . '/' . $branch->uuid . '/edit' }}"
                                                                    data-toggle="modal" data-target="#dynamicPopup-lg"
                                                                     data-keyboard="false"
                                                                    title="View/Edit" data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                                                        class="fa fa-pencil"></i>
                                                                </a>
                                                                <a class="btn btn-outline-dark rounded-10"
                                                                    href="javascript:void(0)"
                                                                    onclick="deletemodel('{{ $branch->uuid }}','{{ Str::ucfirst($branch->branch_name) }}','{{ url('branch') . '/' . $branch->uuid }}')"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            @endforeach

                                            <li class="list-group-item p-1 rounded-10-2 border mt-2">
                                                <table class="table table-borderless mb-0">
                                                    <tr>
                                                        <th style="vertical-align: middle;" class="p-0">
                                                            <h5 class="mb-0 pl-3">Add Another</h5>
                                                        </th>
                                                        <td class="text-right" class="p-0">
                                                            <a class="btn btn-outline-dark rounded-10 dynamicPopup"
                                                                href="javascript:void(0)" data-pop="lg"
                                                                data-url="{{ url('branch/create') }}" data-toggle="modal"
                                                                data-target="#dynamicPopup-lg"
                                                                data-keyboard="false" title="Add"
                                                                data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                                                    class="fa fa-plus-circle"></i></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        @else
                                            <li class="list-group-item p-1 rounded-10-2 border mt-2">
                                                <table class="table table-borderless mb-0">
                                                    <tr>
                                                        <th style="vertical-align: middle;" class="p-0">
                                                            <h5 class="mb-0 pl-3">Add New</h5>
                                                        </th>
                                                        <td class="text-right" class="p-0">
                                                            <a class="btn btn-outline-dark rounded-10 dynamicPopup"
                                                                href="javascript:void(0)" data-pop="lg"
                                                                data-url="{{ url('branch/create') }}" data-toggle="modal"
                                                                data-target="#dynamicPopup-lg"
                                                                data-keyboard="false" title="Add"
                                                                data-image="{{ url(config('constant.LOADING_GIF')) }}"><i
                                                                    class="fa fa-plus-circle"></i></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        @endif


                                    </ul>
                                </div>
                            </div>
                            <div class="card rounded-10 mt-3 shadow animate__animated animate__fadeInUp">
                                <div class="card-body overflow-auto">
                                    <h5 class="mb-0">User Settings</h5>
                                    <ul class="list-group rounded-10-2">
                                        <li class="list-group-item p-1 rounded-10-2 border mt-2">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <th style="vertical-align: middle;" class="p-0">
                                                        <h5 class="mb-0 pl-3">Users & Permissions</h5>
                                                    </th>
                                                    <td class="text-right" class="p-0">
                                                        <a class="btn btn-outline-dark rounded-10"
                                                            href="{{ url('users') }}"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                        <li class="list-group-item p-1 rounded-10-2 mt-2 border">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <th style="vertical-align: middle;" class="p-0">
                                                        <h5 class="mb-0 pl-3">Sign Out</h5>
                                                    </th>
                                                    <td class="text-right" class="p-0">
                                                        <a class="btn btn-outline-dark rounded-10"
                                                            href="{{ url('logout') }}"><i class="fa fa-sign-out"></i></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="DeleteModel-md">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase w-100">If you delete the branch all the master and sale which
                        assign to this branch will be delete</span></h5>
                </div>
                <form action="DELETE" id="delete-user" class="was-validated" autocomplete="off">
                    <input type="hidden" name="uuid" id="uuid" value="">
                    <div class="col-12 p-0">
                        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        {{-- <h5>If you delete the branch all the master and sale which assign to this branch will be delete</h5> --}}
                                        <label class="mb-0">Are you sure you want to delete <span id="delete_name">
                                            </span> branch ..!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                                data-dismiss="modal">Cancel</button>
                            {{-- <button type="submit"
                                class="btn btn-dark px-4 text-uppercase rounded-10 delete_user">Delete</button> --}}
                            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                data-method="newbranch" data-form="delete-user" data-type="DELETE"
                                data-returnaction="reload" data-processing="Please wait, saving..."
                                data-image="{{ url(config('constant.LOADING_GIF')) }}" id="delete-button">Confirm Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        function deletemodel(id, name, delete_url) {
            $('#uuid').val(id);
            $('#delete_name').text(name);
            $('#delete-button').attr('data-target', delete_url);
            $('#DeleteModel-md').modal('show');
        }
    </script>

@endsection
