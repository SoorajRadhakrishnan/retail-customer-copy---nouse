<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoyalityController extends Controller
{
    use ResponseTraits;
    public function index(Request $request)
    {
        // Fetch the first record from the loyalty table
        $loyalty = DB::table('loyality')->first();

// dd($loyalty);
        // Pass the data to the view
        return view('Admin.loyality', compact('loyalty'));
    }
    public function create(Request $request)
    {
        // Fetch the first record from the loyalty table
        $loyalty = DB::table('loyality')->first();

        // Pass the data to the view
        return view('Admin.Model.loyalty', compact('loyalty'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'minimum_sale_amount' => 'required|numeric|min:0',
            'loyalty_points' => 'required|integer|min:0',
            'loyalty_selling_points' => 'required|integer|min:0',
            'loyalty_redeem_amount' => 'required|numeric|min:0',
        ]);

        // Insert or update the record in the loyality table
        DB::table('loyality')->updateOrInsert(
            ['id' => 1], // Assuming there's only one record to update or insert
            [
                'min_sale_amount' => $validated['minimum_sale_amount'],
                'loyalty_points' => $validated['loyalty_points'],
                'selling_points' => $validated['loyalty_selling_points'],
                'redeem_amount' => $validated['loyalty_redeem_amount'],
                'updated_at' => now(),
            ]
        );

        // Redirect back with a success message
        return $this->sendResponse(1,'Loyalty settings updated successfully','','');
    }

}
