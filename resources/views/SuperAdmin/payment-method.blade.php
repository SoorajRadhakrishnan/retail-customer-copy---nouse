@extends('SuperAdmin.Layout.theme')

@section('title', 'PAYMENT METHOD')

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
                            <h2 class="az-dashboard-title">Payment Method</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            <button id="createbtn" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                data-pop="md" data-url="{{ url('payment-method/create') }}"
                                data-toggle="modal" data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                ><i class="fa fa-plus-circle mr-1"></i> Create</button>

                            <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2"
                                onclick="window.location.reload()" title="click to reload this page">Submit</button>
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
                                                <th>Branch</th>
                                                <th>payment method Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($payment_methods) > 0)
                                                @foreach ($payment_methods as $key => $payment_method)
                                                    <tr>
                                                        <td style="width: 15%">{{ $key + 1 }}</td>
                                                        <td>{{ Str::ucfirst($payment_method->branch->branch_name) }}</td>
                                                        <td>{{  Str::ucfirst($payment_method->payment_method_name) }}</td>
                                                        <td>
                                                            <div class="dropstart">
                                                                <a class="dropdown-toggle text-dark" type="button"
                                                                    data-toggle="dropdown" aria-expanded="false">Actions</a>
                                                                <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                    x-placement="bottom-end" style="font-size: 16px;">
                                                                   <li>
                                                                        <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                            data-pop="md"
                                                                            data-url="{{ url('payment-method/')."/".$payment_method->uuid."/edit" }}"
                                                                            data-toggle="modal"
                                                                            data-target="#dynamicPopup-md"

                                                                            data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                            >Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item rounded-0 border-0"
                                                                            href="javascript:void(0)"
                                                                            onclick="deletemodel('{{ $payment_method->uuid }}','{{ $payment_method->payment_method_name }}','Delete payment method','{{ url('payment-method').'/'.$payment_method->uuid }}')">Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
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

    <div class="modal fade show" id="DeleteModel-md">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100"><span id="delete_message"></span></h5>
                </div>
                <form action="DELETE" id="delete-user" class="was-validated" autocomplete="off">
                    <input type="hidden" name="uuid" id="uuid" value="">
                    <div class="col-12 p-0">
                        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Are you sure you want to delete <span
                                                id="delete_name"></span> ..!</label>
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
                                    data-method="newbranch" data-form="delete-user" data-type = "DELETE"
                                    data-returnaction="reload" data-processing="Please wait, saving..." data-image="{{ url(config('constant.LOADING_GIF')) }}" id="delete-button">Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')

<script>
    $('#example').dataTable({
        "language": {
            "emptyTable": "No Data found"
        }
    });

    function deletemodel(id, name, message, delete_url) {
        $('#uuid').val(id);
        $('#delete_name').text(name);
        $('#delete_message').text(message);
        $('#delete-button').attr('data-target', delete_url);
        $('#DeleteModel-md').modal('show');
    }
</script>

@endsection
