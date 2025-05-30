<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Cloudinary\Cloudinary;

class AccountController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        $this->middleware('auth');
        $this->cloudinary = app('cloudinary');
    }

    public function index()
    {
        return view('account', [
            'user' => Auth::user()
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Success', 'Password updated successfully!');
        return redirect()->back();
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture from Cloudinary if exists
            if ($user->profile_picture) {
                $publicId = $this->getPublicIdFromUrl($user->profile_picture);
                if ($publicId) {
                    $this->cloudinary->uploadApi()->destroy($publicId);
                }
            }

            // Upload new profile picture
            $result = $this->cloudinary->uploadApi()->upload(
                $request->file('profile_picture')->getRealPath(),
                [
                    'folder' => 'profiles',
                    'resource_type' => 'image',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]
            );
            
            $profilePictureUrl = $result['secure_url'];
        } else {
            $profilePictureUrl = $user->profile_picture;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->profile_picture = $profilePictureUrl;
        $user->save();

        Alert::success('Success', 'Profile updated successfully!');
        return redirect()->back();
    }

    public function updateSellerInfo(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string',
            'is_seller' => 'boolean'
        ]);

        $user->store_name = $request->store_name;
        $user->store_description = $request->store_description;
        $user->is_seller = $request->has('is_seller');
        $user->save();

        Alert::success('Success', 'Seller information updated successfully!');
        return redirect()->back();
    }

    private function getPublicIdFromUrl($url)
    {
        $pattern = '/\/v\d+\/([^\/]+)\./';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
} 