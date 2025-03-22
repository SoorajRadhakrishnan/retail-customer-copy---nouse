<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Unit;
use App\Models\PaymentMethod;
use App\Models\PriceSize;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    use ResponseTraits;

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branch = null;
        return view('SuperAdmin.Model.branch-model', compact('branch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'branch_name' => 'required',
            'prefix_inv' => 'required',
            'location' => 'required',
            'contact_no' => 'required',
            'vat' => 'required',
            'installation_date' => 'required',
            'expiry_date' => 'required',
            'image' => 'max:2048|mimes:pdf,jpg,png,jpeg|image',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        $imageName = '';
        if($request->image)
        {
            if ($image = $request->file('image')) {
                $destinationPath = storage_path('app/public/image/');
                $profileImage = time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $imageName = $profileImage;
            }
        }else{
            if($request->id)
            {
                $imageName = Branch::where('id',$request->id)->first('image')->image;
            }
        }


        if($request->contact_no)
        {
            $contact_no = ", ". $request->contact_no;
        }
        if($request->email)
        {
            $email = ", ". $request->email;
        }else{
            $email = '';
        }
        if($request->social_media)
        {
            $social_media = ", ". $request->social_media;
        }else{
            $social_media = '';
        }
        $invoice_header = $request->location . $contact_no . $email . $social_media;

        if($request->id)
        {
            Branch::where('id',$request->id)->update([
                'branch_name' => $request->branch_name,
                'prefix_inv' => $request->prefix_inv,
                'location' => $request->location,
                'contact_no' => $request->contact_no,
                'email' => $request->email,
                'social_media' => $request->social_media,
                'vat' => $request->vat,
                'vat_percent' => $request->vat_percent,
                'trn_number' => $request->trn_number,
                'image' => $imageName,
                'installation_date' => $request->installation_date,
                'expiry_date' => $request->expiry_date,
                'invoice_header' => $invoice_header,
            ]);
            return $this->sendResponse(1,'Branch Data Updated','','');
        }else{

            $invoice_header = $request->location . $contact_no . $email . $social_media;
            $branch = Branch::create([
                'branch_name' => $request->branch_name,
                'prefix_inv' => $request->prefix_inv,
                'location' => $request->location,
                'contact_no' => $request->contact_no,
                'email' => $request->email,
                'social_media' => $request->social_media,
                'vat' => $request->vat,
                'vat_percent' => $request->vat_percent,
                'trn_number' => $request->trn_number,
                'image' => $imageName,
                'installation_date' => $request->installation_date,
                'expiry_date' => $request->expiry_date,
                'invoice_header' => $invoice_header,
                'uuid' => Str::uuid(),
            ]);

            Category::create([
                'category_name' => "general",
                'other_name' => "عام",
                'category_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'general'))),
                'branch_id' => $branch->id,
                'uuid' => Str::uuid(),
            ]);

            Unit::create([
                'unit_name' => 'pcs',
                'unit_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'pcs'))),
                'branch_id' => $branch->id,
                'uuid' => Str::uuid(),
            ]);
            Unit::create([
                'unit_name' => 'carton',
                'unit_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'carton'))),
                'branch_id' => $branch->id,
                'uuid' => Str::uuid(),
            ]);

            PaymentMethod::create([
                'payment_method_name' => 'cash',
                'payment_method_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'cash'))),
                'branch_id' => $branch->id,
                'uuid' => Str::uuid(),
            ]);

            PaymentMethod::create([
                'payment_method_name' => 'card',
                'payment_method_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'card'))),
                'branch_id' => $branch->id,
                'uuid' => Str::uuid(),
            ]);

            PaymentMethod::create([
                'payment_method_name' => 'credit',
                'payment_method_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'credit'))),
                'branch_id' => $branch->id,
                'uuid' => Str::uuid(),
            ]);

            PriceSize::create([
                'size_name' => 'Unit price',
                'size_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'Unit price'))),
                'branch_id' => $branch->id,
                'uuid' => Str::uuid(),
            ]);

            return $this->sendResponse(1,'Branch Created','','');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('SuperAdmin.Model.branch-model', compact('branch'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $result = $branch->delete();
        if ($result) {
            return $this->sendResponse(1, 'Branch Deleted succussfully', '', url('settings'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('settings'));
        }
    }
}