@extends('Admin.theme')

@section('title', 'PRODUCTION')

@section('style')

@endsection

@section('content')
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Production</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                            <nav class="nav">
                                <a id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 d-flex justify-content-center align-items-center"
                                    href="{{ url('admin/ingredient') }}"> Ingredient</a>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card rounded-10 shadow">
                            <div class="card-header">
                                <form>
                                    <div class="row">
                                        <div class="w-auto col-md-3">
                                            <div class="form-group mt-0 mb-0">
                                                <label class="mb-0 small">Select Item</label>
                                                <select class="form-control rounded-10 select2 addITem" id="items"
                                                    name="items">
                                                    <option value="">Select Item</option>
                                                    @foreach ($items as $item)
                                                        <?php
                                                        if ($item->size_name === 'Unit price') {
                                                            $item->size_name = ''; // Clear size_name
                                                        }else{
                                                            $item->size_name = ' - '. $item->size_name;
                                                        }
                                                        ?>
                                                        <option value="{{ $item->price_id }}"
                                                            data-price_id="{{ $item->price_id }}"
                                                            data-item_id="{{ $item->item_id }}"
                                                            data-name="{{ $item->item_name }}"
                                                            data-item_size="{{ $item->size_name }}"
                                                            data-cost_price="{{ $item->item_price_cost_price }}"
                                                            data-barcode="{{ $item->item_barcode }}">
                                                            {{ $item->item_name.$item->size_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="valid-feedback">&nbsp;</div>
                                                <div class="invalid-feedback">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="w-auto ml-3 mt-1">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="was-validated" autocomplete="off" id="ProductionForm">
                    @csrf
                    <?php $branch_id = getbranchid(); ?>
                    <input type="hidden" name="branch_id" value="{{ $branch_id }}">
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card rounded-10 shadow">
                                    <div class="card-body overflow-auto">
                                        <table class="table table-hover table-custom border-bottom-0" style="width:100%">
                                            <thead>
                                                <tr>
                                                    {{-- <th style="width:10%">S.No</th> --}}
                                                    <th style="width:60%">Item</th>
                                                    <th style="width:20%">Qty</th>
                                                    <th style="width:20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="item_body">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="az-dashboard-nav border-0">
                            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                data-method="ProductionForm" data-form="ProductionForm"
                                data-target="{{ url('admin/production') }}" data-returnaction="reload"
                                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                data-processing="Please wait, saving...">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#items, #payment_status').select2({
                theme: "bootstrap-5",
            });
        });

        $(".addITem").on("change", function() {
            var rand = Math.floor(Math.random() * 100000);
            var item = $(this).find('option:selected');
            var found = true;
            $('#item_body .price_id').each(function() {
                if ($(this).val() == item.data('price_id')) {
                    found = false;
                }
            });
            if (item.val() != '' && found) {
                var item_name = item.data('name');
                var item_id = item.data('item_id');
                var price_id = item.data('price_id');
                var item_size = item.data('item_size');
                var barcode = item.data('barcode');
                var cost_price = item.data('cost_price');

                let dynamicRowHTML = `
                <tr class="tr` + rand + `">
                    <input type="hidden" class="price_id" name="price_id[]" value="` + price_id + `">
                    <input type="hidden" class="item_id" name="item_id[]" value="` + item_id + `">
                    <input type="hidden" class="item_name" name="item_name[]" value="` + item_name + item_size + `">
                    <td style="width:60%">` + item_name + item_size +
                    `</td>
                    <td style="width:20%">
                        <input type="number" class="form-control rounded-10 qty" placeholder="" name="qty[]" required="" autofocus="" value="1" id="qty` + rand + `"></td>
                    <td style="width:20%">
                        <a class="btn btn-dark rounded-10" onclick="removeRow('` + rand + `')"><i class="fa fa-remove"></i></a></td>
                </tr>`;
                $('#item_body').append(dynamicRowHTML);
                $('.addITem').val('');
            }
        });

        function removeRow(rand) {
            $(".tr" + rand).remove();
        }
    </script>

@endsection
