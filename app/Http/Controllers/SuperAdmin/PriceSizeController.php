<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PriceSize;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PriceSizeController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $price_sizes = PriceSize::all();
        return view('SuperAdmin.price-size', compact('price_sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $price_size = null;
        return view('SuperAdmin.Model.price_size-model', compact('price_size'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'size_name' => [
                                'required',
                                Rule::unique('price_size')
                                ->ignore($request->uuid,'uuid')
                                ->whereNull('deleted_at')
                                ->where(function ($query) use ($request){
                                    return $query->where('branch_id',  $request->branch);
                                }),
                            ],
            'branch' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        if ($request->uuid) {
            PriceSize::where('uuid', $request->uuid)->update([
                'size_name' => $request->size_name,
                'size_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->size_name))),
                'branch_id' => $request->branch,
            ]);
            return $this->sendResponse(1, 'Price Size Updated', '', '');
        } else {

            PriceSize::create([
                'size_name' => $request->size_name,
                'size_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->size_name))),
                'branch_id' => $request->branch,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1, 'Price Size Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PriceSize $price_size, Request $request)
    {
        return view('SuperAdmin.Model.price_size-model', compact('price_size'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PriceSize $price_size)
    {
        $result = $price_size->delete();
        if ($result) {
            return $this->sendResponse(1, 'Price Size Deleted succussfully', '', url('price-size'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('price-size'));
        }
    }
}
