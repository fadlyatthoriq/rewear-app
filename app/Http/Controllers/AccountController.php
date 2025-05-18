<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('account', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'company_name' => 'nullable|string|max:100',
            'vat_number' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->fill($request->only([
            'name',
            'phone',
            'address',
            'company_name',
            'vat_number'
        ]));
        $user->save();

        Alert::success('Success', 'Account information updated successfully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Success', 'Password updated successfully!');
        return redirect()->back();
    }
} 