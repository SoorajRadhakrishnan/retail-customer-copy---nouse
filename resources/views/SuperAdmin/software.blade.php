@extends('SuperAdmin.Layout.theme')

@section('title', 'SOFTWARE SETTING')

@section('style')

    <style>
        .lable_weight {
            font-weight: 600;
        }
    </style>

@endsection

@section('content')

@section('back_url', url('settings'))

@include('SuperAdmin.Layout.header')
{{-- @dd(app('appSettings')) --}}
<div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
    <div class="container-fluid">
        <div class="az-content-body">
            <div class="col-12">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Software Settings</h2>
                        <p class="az-dashboard-text"></p>
                    </div>
                    <div class="az-content-header-right">
                    </div>
                </div>
                <form method="POST" id="SoftwareSettingsForm">
                    @csrf
                    <div class="card rounded-10 shadow">
                        <div class="card-body  border-bottom border-secondary">
                            <div class="collapse show" id="collapseExample">

                                <div class="row d-flex flex-wrap">
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Currency</label>
                                        <input type="text" class="form-control rounded-10 onKeyup" id="currency"
                                            placeholder="AED / OMR / QAR" name="currency"
                                            value="{{ app('appSettings')['currency']->value }}">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Decimal Point</label>
                                        <input type="text" class="form-control rounded-10 onKeyup" id="decimal_point"
                                            placeholder="2 / 3" name="decimal_point"
                                            value="{{ app('appSettings')['decimal_point']->value }}">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    {{-- <div class="col-md-3 mb-3">
                                            <label class="mb-0 d-block lable_weight">Language</label>
                                            <input type="text" class="form-control rounded-10 onKeyup" id="language"
                                                placeholder="en / ar " name="language" value={{ app('appSettings')['language']->value }}>
                                            <div class="valid-feedback">&nbsp;</div>
                                            <div class="invalid-feedback">&nbsp;</div>
                                        </div> --}}
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Date Format</label>
                                        <select class="form-control rounded-10 onChange" id="date_format"
                                            name="date_format">
                                            <option value="Y-m-d"
                                                @if (app('appSettings')['date_format']->value == 'Y-m-d') selected="selected" @endif>
                                                YYYY-MM-DD
                                            </option>
                                            <option value="m-d-Y"
                                                @if (app('appSettings')['date_format']->value == 'm-d-Y') selected="selected" @endif>
                                                MM-DD-YYYY
                                            </option>
                                            <option value="d-m-Y"
                                                @if (app('appSettings')['date_format']->value == 'd-m-Y') selected="selected" @endif>
                                                DD-MM-YYYY
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Time Format</label>
                                        <select class="form-control rounded-10 onChange" id="time_format"
                                            name="time_format">
                                            <option value="H:i:s"
                                                @if (app('appSettings')['time_format']->value == 'H:i:s') selected="selected" @endif>
                                                Hour:Minute:Second </option>
                                            <option value="h:i A"
                                                @if (app('appSettings')['time_format']->value == 'H:i A') selected="selected" @endif>
                                                Hour:Minute
                                                AM/PM </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Unit Price</label>
                                        <select class="form-control rounded-10 onChange" id="unit_price"
                                            name="unit_price">
                                            <option value="no"
                                                @if (app('appSettings')['unit_price']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['unit_price']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Staff Pin</label>
                                        <select class="form-control rounded-10 onChange" id="staff_pin"
                                            name="staff_pin">
                                            <option value="no"
                                                @if (app('appSettings')['staff_pin']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['staff_pin']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Stock Check</label>
                                        <select class="form-control rounded-10 onChange" id="stock_check"
                                            name="stock_check">
                                            <option value="no"
                                                @if (app('appSettings')['stock_check']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['stock_check']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Stock Show In Sale Page</label>
                                        <select class="form-control rounded-10 onChange" id="stock_show"
                                            name="stock_show">
                                            <option value="no"
                                                @if (app('appSettings')['stock_show']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['stock_show']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    {{-- <div class="col-md-3 mb-3">
                                            <label class="mb-0 d-block lable_weight">Custom Product</label>
                                            <select class="form-control rounded-10 onChange" id="custom_product"
                                                name="custom_product">
                                                <option value="no" @if (app('appSettings')['custom_product']->value == 'no') selected="selected"
                                                @endif> NO </option>
                                                <option value="yes" @if (app('appSettings')['custom_product']->value == 'yes') selected="selected" @endif> YES </option>
                                            </select>
                                            <div class="valid-feedback">&nbsp;</div>
                                            <div class="invalid-feedback">&nbsp;</div>
                                        </div> --}}
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Settle Check Pending</label>
                                        <select class="form-control rounded-10 onChange" id="settle_check_pending"
                                            name="settle_check_pending">
                                            <option value="no"
                                                @if (app('appSettings')['settle_check_pending']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['settle_check_pending']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Delivery Sale</label>
                                        <select class="form-control rounded-10 onChange" id="delivery_sale"
                                            name="delivery_sale">
                                            <option value="no"
                                                @if (app('appSettings')['delivery_sale']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['delivery_sale']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Barcode</label>
                                        <select class="form-control rounded-10 onChange" id="barcode"
                                            name="barcode">
                                            <option value="no"
                                                @if (app('appSettings')['barcode']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['barcode']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Cash Drawer Password</label>
                                        <input type="text" class="form-control rounded-10 onKeyup"
                                            id="drawer_password" placeholder="***" name="drawer_password"
                                            value="{{ app('appSettings')['drawer_password']->value }}">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Payback Password</label>
                                        <input type="text" class="form-control rounded-10 onKeyup"
                                            id="payback_password" placeholder="***" name="payback_password"
                                            value="{{ app('appSettings')['payback_password']->value }}">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Purchase and Suppliers</label>
                                        <select class="form-control rounded-10 onChange" id="purchase"
                                            name="purchase">
                                            <option value="no"
                                                @if (app('appSettings')['purchase']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['purchase']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Production</label>
                                        <select class="form-control rounded-10 onChange" id="production"
                                            name="production">
                                            <option value="no"
                                                @if (app('appSettings')['production']->value == 'no') selected="selected" @endif> NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['production']->value == 'yes') selected="selected" @endif> YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">minimum stock alert</label>
                                        <select class="form-control rounded-10 onChange" id="Minimum-stock"
                                            name="Minimum-stock">
                                            <option value="no"
                                                @if (app('appSettings')['Minimum-stock']->value == 'no') selected="selected" @endif>
                                                NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['Minimum-stock']->value == 'yes') selected="selected" @endif>
                                                YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Wastage & Usage</label>
                                        <select class="form-control rounded-10 onChange" id="wastage-usage"
                                            name="wastage-usage">
                                            <option value="no"
                                                @if (app('appSettings')['wastage-usage']->value == 'no') selected="selected" @endif>
                                                NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['wastage-usage']->value == 'yes') selected="selected" @endif>
                                                YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="mb-0 d-block lable_weight">Wastage & Usage zero Stock</label>
                                        <select class="form-control rounded-10 onChange" id="wastage-usage-zero-stock"
                                            name="wastage-usage-zero-stock">
                                            <option value="no"
                                                @if (app('appSettings')['wastage-usage-zero-stock']->value == 'no') selected="selected" @endif>
                                                NO
                                            </option>
                                            <option value="yes"
                                                @if (app('appSettings')['wastage-usage-zero-stock']->value == 'yes') selected="selected" @endif>
                                                YES
                                            </option>
                                        </select>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    {{-- <div class="col-md-3 mb-3">
                                            <label class="mb-0 d-block lable_weight">API KEY</label>
                                            <input type="text" class="form-control rounded-10 onKeyup" id="api_key"
                                                placeholder="API KEY" name="api_key" value="{{ app('appSettings')['api_key']->value }}"">
                                            <div class="valid-feedback">&nbsp;</div>
                                            <div class="invalid-feedback">&nbsp;</div>
                                        </div> --}}
                                </div>


                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-3 mb-3 mt-3">
                                <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                    data-method="newbranch" data-form="SoftwareSettingsForm"
                                    data-target="{{ url('software-settings') }}" data-returnaction="redirect"
                                    data-processing="Please wait, saving..."
                                    data-image="{{ url(config('constant.LOADING_GIF')) }}">Save</button>
                                {{-- <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10">Save</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
