<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{DB, Validator};
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Admin\{Category, Offer, OfferCategory};
use App\Traits\ResponseTraits;

class OfferController extends Controller
{
    use ResponseTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if (!(checkUserPermission('offers'))) {
        //     return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        // }
        $offers = Offer::with('categories')->orderBy('id', 'desc')->get();
        // dd($offers);
        return view('Admin.offers', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // if (!(checkUserPermission('offer_create'))) {
        //     return view('Helper.unauthorized_access');
        // }
        $categories = Category::all();
        $offer = null;
        return view('Admin.Model.OfferModel', compact('categories', 'offer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validation = Validator::make($request->all(), [
    //         'promocode' => [
    //             'required',
    //             'string',
    //             Rule::unique('offers')->ignore($request->uuid, 'uuid')->whereNull('deleted_at'),
    //         ],
    //         'offer_name' => 'required|string|max:255',
    //         'from_date' => 'required|date',
    //         'to_date' => 'required|date|after_or_equal:from_date',
    //         'value' => 'required|numeric',
    //         'type' => 'required|in:percentage,amount',
    //         'categories' => 'required|array',
    //     ]);
    //     if ($validation->fails()) {
    //         return $this->sendResponse(0, '', $validation->errors(), '');
    //     }
    //     $responseMessage = '';
    //     $redirectUrl = '';
    //     DB::transaction(function () use ($request, &$responseMessage, &$redirectUrl) {
    //         if ($request->uuid) {
    //             // if (!(checkUserPermission('offer_edit'))) {
    //             //     $responseMessage = config('constant.UNAUTHORIZED_ACCESS');
    //             //     $redirectUrl = url('admin/offer');
    //             //     return;
    //             // }
    //             $offer = Offer::where('uuid', $request->uuid)->first();
    //             $offer->update([
    //                 'offer_name' => $request->offer_name,
    //                 'promocode' => $request->promocode,
    //                 'from_date' => $request->from_date,
    //                 'to_date' => $request->to_date,
    //                 'value' => $request->value,
    //                 'type' => $request->type,
    //             ]);
    //             OfferCategory::where('offer_id', $offer->id)->delete();
    //             foreach ($request->categories as $categoryId) {
    //                 OfferCategory::create([
    //                     'offer_id' => $offer->id,
    //                     'category_id' => $categoryId,
    //                 ]);
    //             }
    //             $responseMessage = 'Offer Updated';
    //         } else {
    //             // if (!(checkUserPermission('offer_create'))) {
    //             //     $responseMessage = config('constant.UNAUTHORIZED_ACCESS');
    //             //     $redirectUrl = url('admin/offer');
    //             //     return;
    //             // }
    //             $offer = Offer::create([
    //                 'offer_name' => $request->offer_name,
    //                 'promocode' => $request->promocode,
    //                 'from_date' => $request->from_date,
    //                 'to_date' => $request->to_date,
    //                 'value' => $request->value,
    //                 'type' => $request->type,
    //                 'uuid' => Str::uuid(),
    //             ]);
    //             foreach ($request->categories as $categoryId) {
    //                 OfferCategory::create([
    //                     'offer_id' => $offer->id,
    //                     'category_id' => $categoryId,
    //                 ]);
    //             }
    //             $responseMessage = 'Offer Created';
    //         }
    //     });
    //     if ($responseMessage === config('constant.UNAUTHORIZED_ACCESS')) {
    //         return $this->sendResponse(1, $responseMessage, '', $redirectUrl);
    //     }
    //     return $this->sendResponse(1, $responseMessage, '', '');
    // }
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'promocode' => [
                'required',
                'string',
                Rule::unique('offers')->ignore($request->uuid, 'uuid')->whereNull('deleted_at'),
            ],
            'offer_name' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'value' => 'required|numeric',
            'type' => 'required|in:percentage,amount',
            'categories' => 'required|array',
            'min_amt' => 'nullable|numeric', // Add validation rule here
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        $responseMessage = '';
        $redirectUrl = '';
        DB::transaction(function () use ($request, &$responseMessage, &$redirectUrl) {
            if ($request->uuid) {
                $offer = Offer::where('uuid', $request->uuid)->first();
                $offer->update([
                    'offer_name' => $request->offer_name,
                    'promocode' => $request->promocode,
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'value' => $request->value,
                    'type' => $request->type,
                    'min_amt' => $request->min_amt, // Store min_amt here
                ]);
                OfferCategory::where('offer_id', $offer->id)->delete();
                foreach ($request->categories as $categoryId) {
                    OfferCategory::create([
                        'offer_id' => $offer->id,
                        'category_id' => $categoryId,
                    ]);
                }
                $responseMessage = 'Offer Updated';
            } else {
                $offer = Offer::create([
                    'offer_name' => $request->offer_name,
                    'promocode' => $request->promocode,
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'value' => $request->value,
                    'type' => $request->type,
                    'uuid' => Str::uuid(),
                    'min_amt' => $request->min_amt, // Store min_amt here
                ]);
                foreach ($request->categories as $categoryId) {
                    OfferCategory::create([
                        'offer_id' => $offer->id,
                        'category_id' => $categoryId,
                    ]);
                }
                $responseMessage = 'Offer Created';
            }
        });

        if ($responseMessage === config('constant.UNAUTHORIZED_ACCESS')) {
            return $this->sendResponse(1, $responseMessage, '', $redirectUrl);
        }
        return $this->sendResponse(1, $responseMessage, '', '');
    }

    public function getOfferCategories(Request $request)
    {
        if (!$request->expectsJson()) {
            return response()->json(['error' => 'Invalid request type'], 400);
        }
        $offerId = $request->offer_id;
        $offer = Offer::find($offerId);
        if ($offer) {
            return response()->json([
                'categories' => $offer->categories()->pluck('category_id')->toArray(),
                'offer_type' => $offer->type,
                'discount_value' => $offer->value,
                'min_amt'=>$offer->min_amt
            ]);
        }
        return response()->json(['error' => 'Offer not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer, Request $request)
    {
        $offer->load('categories');
        // dd($offer->categories->pluck('id')->toArray()); // Check selected category IDs
        return view('Admin.Model.OfferModel', compact('offer'));
    }

    public function show(Offer $offer)
    {
        // Fetch the offer categories and eager load the related category data
        $offerCategories = $offer->categories()->with('category')->get();

        return view('Counter.Model.offer_categories', compact('offerCategories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        // if (!(checkUserPermission('offer_delete'))) {
        //     return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/offer'));
        // }
        $result = $offer->delete();
        if($result){
            return $this->sendResponse(1,'offer Deleted succussfully','',url('admin/offers'));
        }else{
            return $this->sendResponse(1,'Something Went Wrong! please try again.','',url('admin/offers'));
        }
    }
}
