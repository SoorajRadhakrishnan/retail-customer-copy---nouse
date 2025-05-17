
<div class="pos-item p-1 itemcontent {{ $item->category_slug }} all_cat_items" style="display: block" >
    <button
        class="btn btn-block p-0 btn-white border text-dark rounded-10 shadow text-left pos-item-btn h-100 item-click"
        data-id="{{ $item->id }}"
        data-price_size_id="{{ $item->price_size_id }}"
        data-item_name="{{ $item->item_name }}"
        data-item_other_name="{{ $item->item_other_name }}"
        data-category_id="{{ $item->category_id }}"
        data-item_stock="{{ $item->item_stock }}" data-tax="{{ $item->tax }}"
        data-tax_percent="{{ $item->tax_percent }}"
        data-unit_id="{{ $item->unit_id }}"
        data-item_price_cost_price="{{ $item->item_price_cost_price }}"
        data-price="{{ $item->price }}"
        data-stock_applicable="{{ $item->stock_applicable }}"
        data-price_id="{{ $item->price_id }}">
        <p class="mb-0 px-2  py-1 text-right pos-item-price z-index-10"><b>
                {{ showAmount($item->price, 1) }}</b>
        </p>
        <div class="item-container">
            <p class="mb-0 px-2 py-1 text-right pos-item-price z-index-10 responsive-margin">
                <b>{{ $item->item_stock }}</b>
            </p>
        </div>

        @if ($item->image)
            <div class="image-wrapper">
                <img src="{{ url('storage/item_image') . '/' . optional($item)->image }}"
                    alt="{{ $item->item_name }}" class="img-fluid"
                    onerror="this.onerror=null;this.src='{{ url('assets/img/error-image.webp') }}';">
            </div>
        @else
            <div class="img-wrapper">
                <img src="{{ url('assets/img/error-image.webp') }}"
                    alt="{{ $item->item_name }}" class="img-fluid">
            </div>
        @endif
        @php
            $stock = '';
            if (app('appSettings')['stock_show']->value == 'yes') {
                $stock = $item->stock_applicable ? ' ( ' . $item->item_stock . ' )' : '';
            }
        @endphp
        <div class="desc">
            @if ($item->size_name === 'Unit price')
                {{ '' }}
            @else
                {{ $item->size_name }}
            @endif

            <p class="mb-1 border-bottom text-truncate"
                title="{{ $item->item_stock }}">
                {{-- {{ getPriceName(auth()->user()->branch_id, $item->price_size_id) }} --}}
            </p>
            <p class="mb-0 text-truncate"
                title="{{ Str::ucfirst($item->item_name) }}">
                <b>{{ Str::ucfirst($item->item_name) }}</b>
            </p>
            <p class="mb-0 text-truncate text-right" style="height: 23px !important"
                title="{{ $item->item_other_name }}">
                <b>{{ $item->item_other_name }}</b>
            </p>
        </div>
    </button>
</div>
