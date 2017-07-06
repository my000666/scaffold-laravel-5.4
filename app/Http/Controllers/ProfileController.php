<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Auth, Flash, Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = Auth::user()->profile ?: new UserProfile();

        return view('profile.index', compact('user', 'profile'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required|max:255',
            'email' => "required|email|unique:users,email,".$user->id.",id|max:255",
            'address_1' => 'required|max:255',
            'postcode' => 'required|max:8',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255'
        ];
        if($request->password) {
            $rules['password'] = 'min:5|confirmed';
        }

        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()) {
            Flash::error("Your profile details unsuccessfully updated.");
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $profile = UserProfile::firstOrNew(['user_id' => $user->id]);
        $profile->avatar = '';
        $profile->address_1 = $request->address_1;
        $profile->address_2 = $request->address_2;
        $profile->postcode = $request->postcode;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->country = $request->country;
        $profile->phone = $request->phone;
        $profile->office = $request->office;
        $profile->mobile = $request->mobile;
        $profile->save();

        Flash::success('Your profile details successfully updated.');
        return back()->withInput();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
