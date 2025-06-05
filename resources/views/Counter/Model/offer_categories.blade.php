<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Categories</h5>
</div>
<div class="col-12 p-0">
    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th class="py-2 bg-transparent text-center">S.NO</th>
                    <th class="py-2 bg-transparent text-center">Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offerCategories as $key => $offerCategory)
                    <tr>
                        <td class="py-2 bg-transparent text-center">{{ $key + 1 }}</td>
                        <td class="py-2 bg-transparent text-center">{{ $offerCategory->category->category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Close</button>
    </div>
</div>
