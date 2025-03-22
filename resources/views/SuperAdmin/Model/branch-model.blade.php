<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Create Branch</h5>
</div>
<form action="" id="branchForm" class="was-validated" autocomplete="off">
    <input type="hidden" name="id" value="{{ optional($branch)->id }}">
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0 w-100 text-center">Branch Logo</label>
                        <label class="text-center w-100">
                            <input type="file" class="form-control rounded-10" id="image" placeholder=""
                                name="image" accept="image/x-png, image/gif, image/jpeg"
                                onchange="readURL(this, 'img1');" style="display: none;">

                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-8">
                                    @if (optional($branch)->image)
                                        <img src="{{ url('storage/image/'.optional($branch)->image) }}" class="rounded-10 mt-1 w-100" id="img1">
                                    @else
                                        <img src="{{ url('assets/img/placeholder1.png') }}" class="rounded-10 mt-1 w-100"
                                    id="img1">
                                    @endif
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 pr-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Branch Name</label>
                        <input type="text" class="form-control rounded-10" id="branch_name" placeholder=""
                            name="branch_name" required="" value="{{ optional($branch)->branch_name }}">
                    </div>
                </div>
                <div class="col-md-6 pl-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Branch Inv Prefix</label>
                        <input type="text" class="form-control rounded-10" id="prefix_inv" placeholder=""
                            name="prefix_inv"  required="" value="{{ optional($branch)->prefix_inv }}">
                    </div>
                </div>

                <div class="col-md-6 pr-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Location</label>
                        <input type="text" class="form-control rounded-10" id="location" placeholder=""
                            name="location" required="" value="{{ optional($branch)->location }}">
                    </div>
                </div>
                <div class="col-md-6 pl-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Contact Number</label>
                        <input type="text" class="form-control rounded-10" id="contact_no" placeholder=""
                            name="contact_no" required=""  value="{{ optional($branch)->contact_no }}">
                    </div>
                </div>
                <div class="col-md-6 pr-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Email Address</label>
                        <input type="email" class="form-control rounded-10" id="email" placeholder=""
                            name="email" value="{{ optional($branch)->email }}">
                    </div>
                </div>
                <div class="col-md-6 pl-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Social Media</label>
                        <input type="text" class="form-control rounded-10" id="social_media" placeholder=""
                            name="social_media" value="{{ optional($branch)->social_media }}">
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <label class="mb-0">Branch Admin Username</label>
                                </th>
                                <th class="text-center">
                                    <label class="mb-0">Branch Admin Password</label>
                                </th>
                                <th class="text-center">
                                    <label class="mb-0"><button class="btn btn-dark px-3" id="addBtn"
                                            type="button" style="border-radius:10px;">
                                            <i class="fa fa-plus" aria-hidden="true"></i></button></label>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group mt-0 mb-3">
                                            <input type="text" class="form-control rounded-10" id="username"
                                                placeholder="" name="username" required="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group mt-0 mb-3">
                                            <div class="input-group mb-0">
                                                <input type="text" class="form-control"
                                                    style="border-radius: 10px 0 0 10px;" id="password"
                                                    placeholder="" name="password" required="" value="">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark px-3"
                                                        style="border-radius: 0 10px 10px 0;" type="button"
                                                        onclick="generatePass('password')"><i
                                                            class="fa fa-refresh"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-2">
                                        <div class="form-group mt-0 mb-3">
                                            <button class="btn btn-danger px-3" style="border-radius:10px;" type="button" onclick='removetr(this)'>
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot id='tfoot'>
                            <tr>
                                <td colspan="3" class="text-center">No User Created</td>
                            </tr>
                        </tfoot>
                    </table>
                </div> --}}

                {{-- <div class="col-md-12">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <label class="mb-0">Branch Counter Username</label>
                                </th>
                                <th class="text-center">
                                    <label class="mb-0">Branch Counter Password</label>
                                </th>
                                <th class="text-center">
                                    <label class="mb-0"><button class="btn btn-dark px-3" id="addBtn2"
                                            type="button" style="border-radius:10px;">
                                            <i class="fa fa-plus" aria-hidden="true"></i></button></label>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody2">
                            <tr>
                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group mt-0 mb-3">
                                            <input type="text" class="form-control rounded-10" id="username"
                                                placeholder="" name="username" required="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group mt-0 mb-3">
                                            <div class="input-group mb-0">
                                                <input type="text" class="form-control"
                                                    style="border-radius: 10px 0 0 10px;" id="password"
                                                    placeholder="" name="password" required="" value="">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark px-3"
                                                        style="border-radius: 0 10px 10px 0;" type="button"
                                                        onclick="generatePass('password')"><i
                                                            class="fa fa-refresh"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-2">
                                        <div class="form-group mt-0 mb-3">
                                            <button class="btn btn-danger px-3" style="border-radius:10px;" type="button" onclick='removetr(this)'>
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot id='tfoot2'>
                            <tr>
                                <td colspan="3" class="text-center">No User Created</td>
                            </tr>
                        </tfoot>
                    </table>
                </div> --}}
                <div class="col-md-4 pr-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">VAT</label>
                        <select name="vat" id="vat" class="form-control rounded-10 select2"
                            required="" style="width:100%;">
                            <option value="no_vat"
                            @if (optional($branch)->vat == 'no_vat')
                                selected="selected"
                            @endif>
                                No VAT</option>
                            <option value="inclusive"
                            @if (optional($branch)->vat == 'inclusive')
                                selected="selected"
                            @endif>
                                Inclusive</option>
                            <option value="exclusive"
                            @if (optional($branch)->vat == 'exclusive')
                                selected="selected"
                            @endif>
                                Exclusive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 px-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">VAT Percent</label>
                        <input type="number" class="form-control rounded-10" id="vat_percent" placeholder="5"
                            name="vat_percent"  value="{{ optional($branch)->vat_percent }}">
                    </div>
                </div>
                <div class="col-md-4 pl-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">TRN Number</label>
                        <input type="text" class="form-control rounded-10" id="trn_number"
                            placeholder="TRN: *********" name="trn_number"  value="{{ optional($branch)->trn_number }}" >
                    </div>
                </div>
                <div class="col-md-6 pr-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Installation Date</label>
                        <input type="date" name="installation_date" id="installation_date"
                            class="form-control rounded-10" required  value="{{ optional($branch)->installation_date }}">
                    </div>
                </div>
                <div class="col-md-6 pl-1">
                    <div class="form-group mt-0 mb-3">
                        <label class="mb-0">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" class="form-control rounded-10"
                            required  value="{{ optional($branch)->expiry_date }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="newbranch" data-form="branchForm" data-target="{{ url('branch') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(() => {
        var count = count2 = 1;

        // Adding row on click to Add New Row button
        $('#addBtn').click(function() {
            let dynamicRowHTML = `
        <tr>
            <td>
                <div class="col-md-12">
                    <div class="form-group mt-0 mb-3">
                        <input type="text" class="form-control rounded-10" id="username"
                            placeholder="" name="username[]" required="required">
                    </div>
                </div>
            </td>
            <td>
                <div class="col-md-12">
                    <div class="form-group mt-0 mb-3">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control"
                                style="border-radius: 10px 0 0 10px;" id="password` + count + `"
                                placeholder="" name="password[]" required="required" value="">
                            <div class="input-group-append">
                                <button class="btn btn-dark px-3"
                                    style="border-radius: 0 10px 10px 0;" type="button"
                                    onclick="generatePass('password'` + count + `)"><i
                                        class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="col-md-2">
                    <div class="form-group mt-0 mb-3">
                        <button class="btn btn-danger px-3" style="border-radius:10px;" type="button" onclick='removetr(this,"tbody","tfoot")'>
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
            </td>
        </tr>`;
            $('#tbody').append(dynamicRowHTML);
            count++;
            showfoot('tbody', 'tfoot');
        });

        // Adding row on click to Add New Row button
        $('#addBtn2').click(function() {
            let dynamicRowHTML2 = `
            <tr>
                <td>
                    <div class="col-md-12">
                        <div class="form-group mt-0 mb-3">
                            <input type="text" class="form-control rounded-10" id="username"
                                placeholder="" name="counter_username[]" required="">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <div class="form-group mt-0 mb-3">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control"
                                    style="border-radius: 10px 0 0 10px;" id="password` + count2 + `"
                                    placeholder="" name="counter_password[]" required="" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-dark px-3"
                                        style="border-radius: 0 10px 10px 0;" type="button"
                                        onclick="generatePass('password'` + count2 + `)"><i
                                            class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="col-md-2">
                        <div class="form-group mt-0 mb-3">
                            <button class="btn btn-danger px-3" style="border-radius:10px;" type="button" onclick='removetr(this,"tbody2","tfoot2")'>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>`;
            $('#tbody2').append(dynamicRowHTML2);
            count2++;
            showfoot('tbody2', 'tfoot2');
        });
    })

    function removetr(that, body, foot) {
        that.closest('tr').remove();
        showfoot(body, foot);
    }

    function showfoot(tbdoy, tfoot) {
        var numRows = $("#" + tbdoy + " tr").length;
        if (numRows > 0) {
            $('#' + tfoot).hide();
        } else {
            $('#' + tfoot).show();
        }
    }
</script>

