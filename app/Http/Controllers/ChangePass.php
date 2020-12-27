<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
	public function CPassword(){
		return view('admin.body.change_password');
	}

	//public function UpdatePassword(Request $request){
	//	$validateData = $request->validate([
	//		'oldpassword' => 'required',
	//		'password' => 'required|confirmed'
	//	]);
	//	$hashedPassword = Auth::user()->password;
	//	If(Hash::check($request->oldpassword,$hashedPassword)){
	//		$user = User::find(Auth::id());
	//		$user ->password = Hash::make($request->password);
	//		$user->save();
	//		Auth::logout();
	//		return redirect()->route('login')->with('success','password is changed successfully');
	//	};
	//	else{
	//		return redirect()->back()->with('error','current password is invalid');
	//	}

	//}

	public function PUpdate(){
		if (Auth::user()) {
			$user=User::find(Auth::user()->id);
			if ($user) {
				return view('admin.body.update_profile',compact('user'));
			}
		}
	}

	public function UpdateProfile(Request $request){
		$user = User::find(Auth::user()->id);
		if ($user) {
			$user->name = $request['name'];
			$user->email = $request['email'];

			$user->save();
			return Redirect()->back()->with('success','User Profile is updated Successfully');
		}else{
			return Redirect()->back();
		}
	}
}
