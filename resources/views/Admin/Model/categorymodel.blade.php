{{-- Category --}}
    <div class="modal-header">
        @if (optional($category)->uuid)
            <h5 class="modal-title text-uppercase text-center w-100">Edit Category</h5>
        @else
            <h5 class="modal-title text-uppercase text-center w-100">Create Category</h5>
        @endif
    </div>
    <form id="categoryForm" class="was-validated" autocomplete="off">
        <input type="hidden" name="uuid" value="{{ optional($category)->uuid }}">
        <input type="hidden" name="branch_id" value="{{ (auth()->user()->branch) ? auth()->user()->branch->id : getbranchid() }}">
        @csrf
        <div class="col-12 p-0">
            <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-0 mb-0">
                            <label class="mb-0">Category Name</label>
                            <input type="text" class="form-control rounded-10" id="category_name" placeholder="" name="category_name" required="" autofocus="" value="{{ optional($category)->category_name }}">
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-0 mb-0">
                            <label class="mb-0">Other Name</label>
                            <input type="text" class="form-control rounded-10" id="category_other_name" placeholder="" name="category_other_name" autofocus="" value="{{ optional($category)->other_name }}">
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                    data-method="adminedit" data-form="categoryForm" data-target="{{ url('admin/category') }}"
                    data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}" data-processing="Please wait, saving...">Save</button>
            </div>
        </div>
    </form>

    {{-- <form action="" id="adminForm" class="was-validated" autocomplete="off">
        <input type="hidden" name="id" value="{{ optional($category)->id }}">
        @csrf
        <div class="col-12 p-0">
            <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-0 mb-0">
                            <label class="mb-0">Admin Name</label>
                            <input type="text" class="form-control rounded-10" id="name" placeholder="Admin"
                                name="name" required="" value="{{ optional($category)->category_name }}">
                            <p class="mb-0 small text-danger">To use as username while sign in.</p>
                            <div class="valid-feedback">&nbsp;</div>
                            <div class="invalid-feedback">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mt-0 mb-0">
                            <label class="mb-0">
                                @if (optional($user)->id)
                                    Change Password
                                @else
                                    Password
                                @endif
                            </label>
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" style="border-radius: 10px 0 0 10px;"
                                    id="password" placeholder="*******" name="password" required="" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-dark px-3" style="border-radius: 0 10px 10px 0;"
                                        type="button" onclick="generatePass('password')"><i
                                            class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                    data-dismiss="modal">Cancel</button>
                <button type="reset" class="btn btn-outline-dark px-4 text-uppercase rounded-10">Reset</button>
                <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                    data-method="adminedit" data-form="adminForm" data-target="{{ url('do-mainadmin') }}"
                    data-returnaction="reload" data-processing="Please wait, saving...">Save</button>
            </div>
        </div>
    </form> --}}
    <script>
        $(document).ready(function() {
            $(".modal").removeAttr("tabindex");
            focustoid("category_name");
        });
    </script>
