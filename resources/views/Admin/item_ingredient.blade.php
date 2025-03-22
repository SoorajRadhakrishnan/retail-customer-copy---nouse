    @extends('Admin.theme')

@section('title', 'INGREDIENT')

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Ingredient</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                            <nav class="nav">
                                <a id="createbtn"
                                class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2"
                                href="{{ url('admin/production') }}"> production</a>
                            </nav>
                        </div>
                    </div>
                    {{-- <div class="az-dashboard-nav border-0"> --}}
                        <div class="card rounded-10 shadow">
                            <div class="card-header">
                                <form>
                                    <div class="row">
                                        <!-- Category Dropdown -->


                                        <!-- Item Type Dropdown -->

                                        <!-- Item Dropdown -->
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">Item</label>
                                            {{-- <form > --}}
                                                <select class="form-control rounded-10 select2" id="item_id" name="item_id" onchange="this.form.submit()">
                                                    <option value="">Select Item</option>
                                                    @foreach ($items as $value)
                                                        <option value="{{ $value->id }}"
                                                            @if (isset($item_id) && $value->id == $item_id) selected="selected" @endif>
                                                            {{ Str::ucfirst($value->item_name) }}
                                                            {{ $value->size_name === 'Unit price' ? '' : ' - ' . $value->size_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            {{-- </form> --}}
                                        </div>

                                        <!-- Refresh Button -->
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- <nav class="nav">
                            <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2"
                                onclick="window.location.reload()" title="click to reload this page"><i
                                    class="fa fa-refresh mr-0"></i></button>
                            <a class="nav-link rounded-10 mr-2 d-none" href="#"><i class="fas fa-ellipsis-h"></i></a>
                        </nav> --}}
                    {{-- </div> --}}
                </div>
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                                                   <table id="example1" class="table table-hover table-custom border-bottom-0"

                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Item Name</th>
                                                <th>Add Ingredient</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($items) > 0)
                                                @foreach ($items as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($item->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>
                                                        <?php
                                                        // Replace "Unit price" with blank space in size_name if applicable
                                                        if ($item->size_name === 'Unit price') {
                                                            $item->size_name = ''; // Set to empty string
                                                        }
                                                        ?>
                                                        {{ Str::ucfirst($item->item_name) }}{{ $item->size_name ? ' - ' . $item->size_name : '' }}
                                                    </td>
                                                        <td>
                                                        <button id="createbtn"
                                                            class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                                            data-pop="lg" data-url="{{ url('admin/ingredient/create') }}?id={{ $item->price_id }}&branch={{ $item->branch_id }}"
                                                            data-toggle="modal" data-target="#dynamicPopup-lg" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                            ><i class="fa fa-plus-circle mr-1"></i></button>
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

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#item_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>


@endsection
