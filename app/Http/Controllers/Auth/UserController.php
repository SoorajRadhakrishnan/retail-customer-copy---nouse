<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use SoftDeletes, ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(Auth::user()->usertype == 'superadmin')
        // {
        //     return redirect('settings');

        // }elseif(Auth::user()->usertype == 'mainadmin' || Auth::user()->usertype == 'admin')
        // {
        //     return redirect('admin/dashboard');
        // }elseif(Auth::user()->usertype == 'counter')
        // {
        //     return redirect('home');
        // }
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $request['password'] = strtolower($request['password']);

        $user = User::where('name', $request->name)->first();

        if ($user !== null) {
            if ($user->usertype == 'superadmin') {
                if (Auth::attempt($request->only('name', 'password'))) {
                    Auth::login($user);
                    return redirect('settings')->withMessage("Login Success");
                } else {
                    return redirect('login')->withMessage('Invalid Username and Password')->withInput();
                }
            }

            if ($user->usertype == 'mainadmin') {
                if (Auth::attempt($request->only('name', 'password'))) {
                    Auth::login($user);
                    return redirect('admin/dashboard')->withMessage("Login Success");
                } else {
                    return redirect('login')->withMessage('Invalid Username and Password')->withInput();
                }
            }

            $installation_date =  $user->branch->installation_date;
            $expiry_date = $user->branch->expiry_date;

            if ($expiry_date > $installation_date) {
                if (Auth::attempt($request->only('name', 'password'))) {
                    Auth::login($user);
                    // $this->redirectPath($user);
                    if ($user->usertype == 'superadmin') {
                        return redirect('settings')->withMessage("Login Success");
                    } elseif ($user->usertype == 'mainadmin' || $user->usertype == 'admin') {
                        return redirect('admin/dashboard')->withMessage('Login Success');
                    } else {
                        return redirect('home')->withMessage('Login Success');
                    }
                } else {
                    return redirect('login')->withMessage('Invalid Username and Password')->withInput();
                }
            } else {
                return redirect('login')->withMessage('Login expired. Please Contact zaadplatforms.com')->withInput();
            }
        } else {
            return redirect('login')->withMessage('Invalid Username')->withInput();
        }
    }

    public function logout()
    {
        clearSessionBranch();
        Auth::logout();
        return redirect('login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $delete_id = $request->uuid;
        $result = User::where('uuid', $delete_id)->delete();
        if ($result) {
            return $this->sendResponse(1, 'User Deleted succussfully', '', url('users'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('users'));
        }
        // return redirect('manage-expenses')->withMessage('Expense Deleted Succesfully');
        //Session::flash('message', 'Something Went Wrong! please try again.');
        // $response = array("message" => null, "url" => "redirect('user')->with('Message','Something Went Wrong! please try again.')");
        // if($result)
        // {
        //     //Session::flash('message', 'Deleted successfullyasdfj;klj');
        //     $response = array("message" => "success", "url" => "redirect('user')->with('Message','Deleted successfullys')");
        // }
        // return json_encode($response);
        // die;
    }

    public function redirectPath($user)
    {
        if ($user->usertype == 'superadmin') {
            return redirect('settings')->withMessage("Login Success");
        } elseif ($user->usertype == 'mainadmin' || $user->usertype == 'admin') {
            return redirect('admin/dashboard')->withMessage('Login Success');
        } else {
            return redirect('home')->withMessage('Login Success');
        }
    }


    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'password' => 'min:4|required',
            'password_confirmation' => 'min:4|required_with:password|same:password',
            'id' => 'required',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        User::where('id', $request->id)->update([
            'password' => Hash::make(strtolower($request->password))
        ]);

        return $this->sendResponse(1,'Password Changed successfully','','');
    }
}
