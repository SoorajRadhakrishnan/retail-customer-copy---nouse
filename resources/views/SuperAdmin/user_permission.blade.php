@extends('SuperAdmin.Layout.theme')

@section('title', 'SOFTWARE SETTING')

@section('style')

    <style>
        .settingscard {
            border: 2px solid #2d374b;
            text-align: center;
            font-size: 17px;
            padding: 0px;
            margin: 0px 60px;
            width: 100%
        }
    </style>

@endsection

@section('content')

    @section('back_url', url('users'))

    @include('SuperAdmin.Layout.header')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Users & Permissions</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <form method="POST" id="userPermissionForm">
                        @csrf
                        <input type="hidden" name="uuid" value="{{ optional($user)->uuid }}">
                        <div class="card rounded-10 shadow">
                            {{-- <div class="card-header">
                                <div class="mb-3 mt-3">
                                    <h2 class="az-dashboard-title">Users & Permissions</h2>
                                    <p class="az-dashboard-text"></p>
                                </div>
                            </div> --}}
                            <div class="card-header  border-bottom border-secondary">
                                <div class="mb-3 mt-3">
                                    <div class="collapse show" id="collapseExample">

                                        <div class="row d-flex flex-wrap">
                                            <div class="col-md-3 mb-3">
                                                <label class="mb-0 d-block">User Name</label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control rounded-10" placeholder="User Name"
                                                    value="{{ old('name', optional($user)->name) }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="mb-0 d-block">Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control rounded-10" placeholder="***********"
                                                    value="">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="mb-0 d-block">User Type</label>
                                                <select class="form-control rounded-10 onChange usertype" id="usertype"
                                                    name="usertype">
                                                    <option value="">Select User</option>
                                                    <option value="mainadmin"
                                                        @if (optional($user)->usertype == 'mainadmin') selected @endif>Main Admin
                                                    </option>
                                                    <option value="admin"
                                                        @if (optional($user)->usertype == 'admin') selected @endif>Admin</option>
                                                    <option value="counter"
                                                        @if (optional($user)->usertype == 'counter') selected @endif>Counter
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="mb-0 d-block">Branch</label>
                                                <select class="form-control rounded-10 onChange branch" id="branch"
                                                    name="branch">
                                                    <option value="">Select Branch</option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}"
                                                            @if (optional($user)->branch_id == $branch->id) selected @endif>
                                                            {{ Str::ucfirst($branch->branch_name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="permission">
                            </div>
                            {{-- <div class="card-body  border-bottom border-secondary permission_admin_list "
                                style="display:none;">
                                <div class="collapse show" id="collapseExample">
                                    <div class="row">
                                        <?php //$main_settings = \App\Models\Permission::get_usertype_settings('admin'); ?>
                                        @foreach ($main_settings as $settings)
                                            <div class="col-md-3 rounded-10 settingscard">
                                                <div class="col-md-12 mb-3 p-3 bg-secondary">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $settings->name }}" id="{{ $settings->name }}"
                                                        name="permission[]">
                                                    <label class="form-check-label" for="{{ $settings->name }}">
                                                        {{ Str::ucfirst(str_replace('_', ' ', $settings->name)) }}
                                                    </label>
                                                </div>
                                                <?php //$sub_settings = \App\Models\Permission::get_sub_settings($settings->id); ?>
                                                @foreach ($sub_settings as $sub_setting)
                                                    <div class="col-md-12 p-2 rounded-10"
                                                        style="text-align:center;font-size:17px;border:2px solid #;width:90%;margin:20px">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $sub_setting->name }}"
                                                            id="{{ $sub_setting->name }}" name="permission[]">
                                                        <label class="form-check-label"
                                                            for="{{ $sub_setting->name }}">
                                                            {{ Str::ucfirst(str_replace('_', ' ', $sub_setting->name)) }}
                                                        </label>
                                                        <div class="mt-3">
                                                            <?php //$sub_settings_actions = \App\Models\Permission::get_sub_settings($sub_setting->id); ?>
                                                            @foreach ($sub_settings_actions as $sub_settings_action)
                                                                <div class="col-md-12 p-2 rounded-10"
                                                                    style="text-align:center;font-size:17px;">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $sub_settings_action->name }}"
                                                                        id="{{ $sub_settings_action->name }}"
                                                                        name="permission[]">
                                                                    <label class="form-check-label"
                                                                        for="{{ $sub_settings_action->name }}">
                                                                        {{ Str::ucfirst(str_replace('_', ' ', $sub_settings_action->name)) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                            <?php
                                $admin_list = "display: none;";
                                if(optional($user)->usertype == 'admin' || optional($user)->usertype == 'mainadmin')
                                {
                                    $admin_list = "display: block;";
                                }

                                $permissions = optional($user)->permissions;
                                // $get = getUserPermissions(optional($user)->id);
                                $permission_value = \App\Models\Permission::getUserPermissions(optional($user)->id);
                                //dd($permission_value);

                            ?>
                            <div class="card card-body rounded-10 px-3 py-2 permission_admin_list" style="{{ $admin_list }}">
                                <div>
                                    <a class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 pt-2 checkAll"
                                        title="click to reload this page"><i class="fa fa-check"></i> Check All</a>
                                    <a class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 pt-2 UncheckAll"
                                        title="click to reload this page"><i class="fa fa-times"></i> Uncheck All</a>
                                </div>
                                <div class="row">
                                    <?php $main_settings = \App\Models\Permission::get_usertype_settings('admin'); ?>
                                    @foreach ($main_settings as $key => $main_setting)
                                        <div class="col-md-4">
                                            <div class="form-check" onclick="MasterClicked('master')">
                                                <input class="form-check-input cursor-pointer cb-main-section"
                                                    type="checkbox" value="{{ $main_setting->name }}"
                                                    id="{{ $main_setting->name }}" data-section="master"
                                                    name="permission[]" <?php if(in_array($main_setting->name,$permission_value)){ echo "checked";}?>>
                                                <label class="form-check-label no-select cursor-pointer"
                                                    for="{{ $main_setting->name }}">
                                                    <strong>{{ Str::ucfirst(str_replace('_', ' ', $main_setting->name)) }}</strong>
                                                </label>
                                            </div>
                                            <?php $sub_settings = \App\Models\Permission::get_sub_settings($main_setting->id); ?>
                                            @foreach ($sub_settings as $sub_setting)
                                                <div class="form-check pl-4">
                                                    <input class="form-check-input cursor-pointer main-master "
                                                        onclick="MasterClicked2('categoriesall', '2')"
                                                        type="checkbox" value="{{ $sub_setting->name }}"
                                                        id="{{ $sub_setting->name }}" name="permission[]"  <?php if(in_array($sub_setting->name,$permission_value)){ echo "checked";}?>>
                                                    <label class="form-check-label no-select cursor-pointer"
                                                        for="{{ $sub_setting->name }}">
                                                        <b
                                                            class="text-dark">{{ Str::ucfirst(str_replace('_', ' ', $sub_setting->name)) }}</b>
                                                    </label>
                                                </div>
                                                <?php $sub_settings_actions = \App\Models\Permission::get_sub_settings($sub_setting->id); ?>
                                                @foreach ($sub_settings_actions as $sub_settings_action)
                                                    <div class="form-check pl-5">
                                                        <input
                                                            class="form-check-input cursor-pointer main-master categoriesall"
                                                            onclick="" type="checkbox"
                                                            value="{{ $sub_settings_action->name }}"
                                                            id="{{ $sub_settings_action->name }}" name="permission[]"  <?php if(in_array($sub_settings_action->name,$permission_value)){ echo "checked";}?>>
                                                        <label class="form-check-label no-select cursor-pointer"
                                                            for="{{ $sub_settings_action->name }}">
                                                            {{ Str::ucfirst(str_replace('_', ' ', $sub_settings_action->name)) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <?php
                                $couner_list = "display: none;";
                                if(optional($user)->usertype == 'counter')
                                {
                                    $couner_list = "display: block;";
                                }
                            ?>
                            <div class="card card-body rounded-10 px-3 py-2 permission_counter_list" style="{{ $couner_list }}">
                                <div>
                                    <a class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 pt-2 checkAll"
                                        title="Check All"><i class="fa fa-check"></i> Check All</a>
                                    <a class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 pt-2 UncheckAll"
                                        title="Uncheck All"><i class="fa fa-times"></i> Uncheck All</a>
                                </div>
                                <div class="row">
                                    <?php $main_settings = \App\Models\Permission::get_usertype_settings('counter'); ?>
                                    @foreach ($main_settings as $main_setting)
                                        <div class="col-md-4">
                                            <div class="form-check" onclick="MasterClicked('master')">
                                                <input class="form-check-input cursor-pointer cb-main-section"
                                                type="checkbox" value="{{ $main_setting->name }}"
                                                    id="{{ $main_setting->name }}" data-section="master"
                                                    name="permission[]" <?php if(in_array($main_setting->name,$permission_value)){ echo "checked";}?>>
                                                <label class="form-check-label no-select cursor-pointer"
                                                    for="{{ $main_setting->name }}">
                                                    <strong>{{ Str::ucfirst(str_replace('_', ' ', $main_setting->name)) }}</strong>
                                                </label>
                                            </div>
                                            <?php $sub_settings = \App\Models\Permission::get_sub_settings($main_setting->id); ?>
                                            @foreach ($sub_settings as $sub_setting)
                                                <div class="form-check pl-4">
                                                    <input class="form-check-input cursor-pointer main-master "
                                                        onclick="MasterClicked2('categoriesall', '2')"
                                                        type="checkbox" value="{{ $sub_setting->name }}"
                                                        id="{{ $sub_setting->name }}" name="permission[]" <?php if(in_array($sub_setting->name,$permission_value)){ echo "checked";}?>>
                                                    <label class="form-check-label no-select cursor-pointer"
                                                        for="{{ $sub_setting->name }}">
                                                        <b
                                                            class="text-dark">{{ Str::ucfirst(str_replace('_', ' ', $sub_setting->name)) }}</b>
                                                    </label>
                                                </div>
                                                <?php $sub_settings_actions = \App\Models\Permission::get_sub_settings($sub_setting->id); ?>
                                                @foreach ($sub_settings_actions as $sub_settings_action)
                                                    <div class="form-check pl-5">
                                                        <input
                                                            class="form-check-input cursor-pointer main-master categoriesall"
                                                            onclick="" type="checkbox"
                                                            value="{{ $sub_settings_action->name }}"
                                                            id="{{ $sub_settings_action->name }}" name="permission[]" <?php if(in_array($sub_settings_action->name,$permission_value)){ echo "checked";}?>>
                                                        <label class="form-check-label no-select cursor-pointer"
                                                            for="{{ $sub_settings_action->name }}">
                                                            {{ Str::ucfirst(str_replace('_', ' ', $sub_settings_action->name)) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- <div class="card-body  border-bottom border-secondary permission_counter_list "
                                style="display:none;">
                                <div class="collapse show" id="collapseExample">
                                    <div class="row">
                                        <?php //$main_settings = \App\Models\Permission::get_usertype_settings('counter'); ?>
                                        @foreach ($main_settings as $settings)
                                            <div class="col-md-3 rounded-10 settingscard">
                                                <div class="col-md-12 mb-3 p-3 bg-secondary">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $settings->name }}" id="{{ $settings->name }}"
                                                        name="permission[]">
                                                    <label class="form-check-label" for="{{ $settings->name }}">
                                                        {{ Str::ucfirst(str_replace('_', ' ', $settings->name)) }}
                                                    </label>
                                                </div>
                                                <?php //$sub_settings = \App\Models\Permission::get_sub_settings($settings->id); ?>
                                                @foreach ($sub_settings as $sub_setting)
                                                    <div class="col-md-12 p-2 rounded-10"
                                                        style="text-align:center;font-size:17px;border:2px solid #2d374b;width:90%;margin:20px">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $sub_setting->name }}"
                                                            id="{{ $sub_setting->name }}" name="permission[]">
                                                        <label class="form-check-label"
                                                            for="{{ $sub_setting->name }}">
                                                            {{ Str::ucfirst(str_replace('_', ' ', $sub_setting->name)) }}
                                                        </label>
                                                        <div class="mt-3">
                                                            <?php //$sub_settings_actions = \App\Models\Permission::get_sub_settings($sub_setting->id); ?>
                                                            @foreach ($sub_settings_actions as $sub_settings_action)
                                                                <div class="col-md-12 p-2 rounded-10"
                                                                    style="text-align:center;font-size:17px;">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $sub_settings_action->name }}"
                                                                        id="{{ $sub_settings_action->name }}"
                                                                        name="permission[]">
                                                                    <label class="form-check-label"
                                                                        for="{{ $sub_settings_action->name }}">
                                                                        {{ Str::ucfirst(str_replace('_', ' ', $sub_settings_action->name)) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                            <?php
                                $text_list = "display: block;";
                                if(optional($user)->usertype != '')
                                {
                                    $text_list = "display: none;";
                                }
                            ?>
                            <div class="card-body  border-bottom border-secondary permission_text" style="{{ $text_list }}">
                                <div class="collapse show" id="collapseExample">
                                    <div>
                                        <h5>Select User Type for permissions</h5>
                                        {{-- <div class="col-md-3 mb-3" id="permission"></div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row d-flex flex-wrap">
                                    <div class="col-md-3 mb-3 mt-3">
                                        <button type="submit"
                                        class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                        data-method="newbranch" data-form="userPermissionForm"
                                        data-target="{{ url('store-user-permission') }}" data-returnaction="redirect"
                                        data-processing="Please wait, saving..." data-image="{{ url(config('constant.LOADING_GIF')) }}">Save</button>
                                        {{-- <button type="submit"
                                            class="btn btn-dark px-4 text-uppercase rounded-10">Save</button> --}}
                                    </div>
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

    <script>
        $('.usertype').on('change', function(e) {
            var usertype = $(this).val();
            if (usertype == 'admin' || usertype == 'mainadmin') {
                $('.permission_admin_list').show();
                $('.permission_counter_list').hide();
                $('.permission_text').hide();
            } else if (usertype == 'counter') {
                $('.permission_counter_list').show();
                $('.permission_admin_list').hide();
                $('.permission_text').hide();
            } else {
                $('.permission_text').show();
                $('.permission_admin_list').hide();
                $('.permission_counter_list').hide();
            }
        });

        $(".checkAll").click(function(){
            $('input:checkbox').prop('checked', true);
        });
        $(".UncheckAll").click(function(){
            $('input:checkbox').prop('checked', false);
        });
    </script>

@endsection
