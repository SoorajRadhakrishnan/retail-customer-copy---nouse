<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Models\Branch;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Models\UserHasPermissions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    use ResponseTraits;

    public function index()
    {
        $branches = Branch::whereNull('deleted_at')->get();
        $mainAdmin = User::where('usertype','mainadmin')->first();
        return view('SuperAdmin.setting',compact('branches','mainAdmin'));
    }

    // public function mainadmin(Request $request,$user = '')
    // {
    //     $branch = '';
    //     $name = $request->input('view');
    //     if($name == 'branch' && $user != '')
    //     {
    //         $branch = Branch::where('id',$user)->first();
    //     };
    //     if($name != 'branch' && $user != '')
    //     {
    //         $user = User::where('id',$user)->first();
    //     }
    //     return view('Model.model',compact('user','name','branch'));
    // }

    // public function mainadminaction(Request $request)
    // {
    //     $validation = Validator::make($request->all(),[
    //         'name' => 'required',
    //         'password' => 'required'
    //     ]);

    //     if($validation->fails())
    //     {
    //         return $this->sendResponse(0,'',$validation->errors(),'');
    //     }

    //     if($request->id)
    //     {
    //         User::where('id',$request->id)->update([
    //             'name' => $request->name,
    //             'password' => Hash::make($request->password),
    //         ]);
    //         return $this->sendResponse(1,'Data Updated','','');
    //     }else{
    //         User::create([
    //             'name' => $request->name,
    //             'password' => Hash::make($request->password),
    //             'usertype' => 'mainadmin',
    //             'uuid' => Str::uuid(),
    //         ]);
    //         return $this->sendResponse(1,'App Admin Created','','');
    //     }

    // }

    // public function branchesaction(Request $request)
    // {
    //     $validation = Validator::make($request->all(),[
    //         'branch_name' => 'required',
    //         'prefix_inv' => 'required',
    //         'location' => 'required',
    //         'contact_no' => 'required',
    //         'vat' => 'required',
    //         'installation_date' => 'required',
    //         'expiry_date' => 'required',
    //         'image' => 'max:2048|mimes:pdf,jpg,png,jpeg|image',
    //     ]);

    //     if($validation->fails())
    //     {
    //         return $this->sendResponse(0,'',$validation->errors(),'');
    //     }

    //     $imageName = '';
    //     if($request->image)
    //     {
    //         if ($image = $request->file('image')) {
    //             $destinationPath = 'image/';
    //             $profileImage = time() . "." . $image->getClientOriginalExtension();
    //             $image->move($destinationPath, $profileImage);
    //             $imageName = $profileImage;
    //         }
    //     }else{
    //         if($request->id)
    //         {
    //             $imageName = Branch::where('id',$request->id)->first('image')->image;
    //         }
    //     }


    //     if($request->contact_no)
    //     {
    //         $contact_no = ", ". $request->contact_no;
    //     }
    //     if($request->email)
    //     {
    //         $email = ", ". $request->email;
    //     }else{
    //         $email = '';
    //     }
    //     if($request->social_media)
    //     {
    //         $social_media = ", ". $request->social_media;
    //     }else{
    //         $social_media = '';
    //     }
    //     $invoice_header = $request->location . $contact_no . $email . $social_media;

    //     if($request->id)
    //     {
    //         Branch::where('id',$request->id)->update([
    //             'branch_name' => $request->branch_name,
    //             'prefix_inv' => $request->prefix_inv,
    //             'location' => $request->location,
    //             'contact_no' => $request->contact_no,
    //             'email' => $request->email,
    //             'social_media' => $request->social_media,
    //             'vat' => $request->vat,
    //             'vat_percent' => $request->vat_percent,
    //             'trn_number' => $request->trn_number,
    //             'image' => $imageName,
    //             'installation_date' => $request->installation_date,
    //             'expiry_date' => $request->expiry_date,
    //             'invoice_header' => $invoice_header,
    //         ]);
    //         return $this->sendResponse(1,'Branch Data Updated','','');
    //     }else{

    //         $invoice_header = $request->location . $contact_no . $email . $social_media;
    //         Branch::create([
    //             'branch_name' => $request->branch_name,
    //             'prefix_inv' => $request->prefix_inv,
    //             'location' => $request->location,
    //             'contact_no' => $request->contact_no,
    //             'email' => $request->email,
    //             'social_media' => $request->social_media,
    //             'vat' => $request->vat,
    //             'vat_percent' => $request->vat_percent,
    //             'trn_number' => $request->trn_number,
    //             'image' => $imageName,
    //             'installation_date' => $request->installation_date,
    //             'expiry_date' => $request->expiry_date,
    //             'invoice_header' => $invoice_header,
    //         ]);
    //         return $this->sendResponse(1,'Branch Created','','');
    //     }
    // }

    public function softwaresettingview()
    {
        $settings= Setting::whereNull('deleted_at')->get();
        return view('SuperAdmin.software',compact('settings'));
    }

    public function storesoftwaresetting(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),[
            'currency' => 'required|in:AED,OMR,QAR',
            'decimal_point' => 'required|integer',
            'date_format' => 'required',
            'time_format' => 'required',
            'unit_price' => 'required',
            'stock_check' => 'required',
            'stock_show' => 'required',
            'settle_check_pending' => 'required',
            'delivery_sale' => 'required',
        ],[
            'currency.in' => [ "Currency must be AED | OMR | QAR" ]
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }
        $data = $request->except('_token');
        // dd($data);

        foreach($data as $key => $value)
        {

            $settings = Setting::where('key',$key)->first();
            if($settings)
            {
                Setting::where('key',$key)->update(['value'=> $value]);
            }else{
                Setting::create([
                    'key' => $key,
                    'value' => $value
                ]);
            }
        }
        return $this->sendResponse(1,'Settings Updated','',url('settings'));
        // $settings = Setting::where('key',);

        // if($settings)
        // {
        //     $settings->update([
        //         'currency' => $request->currency,
        //         'decimal_point' => $request->decimal_point,
        //         'date_format' => $request->date_format,
        //         'time_format' => $request->time_format,
        //         'unit_price' => $request->unit_price,
        //         'stock_check' => $request->stock_check,
        //         'stock_show' => $request->stock_show,
        //         'settle_check_pending' => $request->settle_check_pending,
        //         'delivery_sale' => $request->delivery_sale,
        //     ]);
        // }else
        // {
        //     Setting::create([
        //         'currency' => $request->currency,
        //         'decimal_point' => $request->decimal_point,
        //         'date_format' => $request->date_format,
        //         'time_format' => $request->time_format,
        //         'unit_price' => $request->unit_price,
        //         'stock_check' => $request->stock_check,
        //         'stock_show' => $request->stock_show,
        //         'settle_check_pending' => $request->settle_check_pending,
        //         'delivery_sale' => $request->delivery_sale
        //     ]);
        // }
        // return redirect('settings')->withMessage('Settings Updated');
    }

    public function users_list()
    {
        $users = User::where('usertype', '!=' , 'superadmin')->get();
        return view('SuperAdmin.user',compact('users'));
    }

    public function user_permission(User $user)
    {
        $branches = Branch::whereNull('deleted_at')->get();
        //dd($main_settings);
        return view('SuperAdmin.user_permission',compact('user','branches'));
    }

    public function store_user_and_permission(Request $request)
    {
        // dd($request->all());

        // if(empty($request->permission))
        // {
        //     return redirect('user-permission')->withMessage('Select Permissions')->withInput();
        // }
        if($request->uuid)
        {
            if($request->usertype != 'mainadmin')
            {
                $validation = Validator::make($request->all(),[
                    'name' => ['required',Rule::unique('users')->ignore($request->uuid,'uuid')->whereNull('deleted_at')],
                    'usertype' => 'required',
                    'branch' => 'required',
                    'permission' => 'required|present|array|min:1'
                ]);
            }else{
                $validation = Validator::make($request->all(),[
                    'name' => ['required',Rule::unique('users')->ignore($request->uuid,'uuid')->whereNull('deleted_at')],
                    'usertype' => 'required',
                    'permission' => 'required|present|array|min:1'
                ]);
            }

            if($validation->fails())
            {
                return $this->sendResponse(0,'',$validation->errors(),'');
            }

            if($request->password)
            {
                $data = [
                    'name' => $request->name,
                    'password' => Hash::make(strtolower($request->password)),
                    'usertype' => $request->usertype,
                    'branch_id' => $request->branch,
                ];
            }else{
                $data = [
                    'name' => $request->name,
                    'usertype' => $request->usertype,
                    'branch_id' => $request->branch,
                ];
            }

            User::where('uuid',$request->uuid)->update($data);

            $user = User::where('uuid',$request->uuid)->first();
            UserHasPermissions::where('user_id',$user->id)->delete();
            foreach($request->permission as $permission)
            {
                $user->permissions()->saveMany([
                            new UserHasPermissions([
                            'user_id' => $user->id,
                            'action' => $permission,])

                ]);
            }

            return $this->sendResponse(1,'User updated succussfully','',url('users'));
        }else{
            if($request->usertype != 'mainadmin')
            {
                $validation = Validator::make($request->all(),[
                    'name' => ['required',Rule::unique('users')->ignore($request->uuid,'uuid')->whereNull('deleted_at')],
                    'password' => 'required',
                    'usertype' => 'required',
                    'branch' => 'required',
                    'permission' => 'required|present|array|min:1'
                ]);
            }else{
                $validation = Validator::make($request->all(),[
                    'name' => ['required',Rule::unique('users')->ignore($request->uuid,'uuid')->whereNull('deleted_at')],
                    'password' => 'required',
                    'usertype' => 'required',
                    'permission' => 'required|present|array|min:1'
                ]);
            }

            if($validation->fails())
            {
                return $this->sendResponse(0,'',$validation->errors(),'');
            }

            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make(strtolower($request->password)),
                'usertype' => $request->usertype,
                'branch_id' => $request->branch,
                'uuid' => Str::uuid(),
            ]);

            $user_permissions = array();
            foreach($request->permission as $permission)
            {
                $user_permissions[] = [
                    'user_id' => $user->id,
                    'action' => $permission,
                ];
            }
            $user->permissions()->createMany($user_permissions);
            return $this->sendResponse(1,'User created succussfully','',url('users'));
        }
    }
}
