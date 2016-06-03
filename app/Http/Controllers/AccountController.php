<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {
	public function getPassword() {
		return view('admin/account/password');
	}

	public function postPassword(Request $request) {

		$user = $request->user();

		if (!Hash::check($request->get('current_password'), $user->password)) {
			return redirect()->back()->withErrors([
				'current_password' => 'The current password is not valid',
			]);
		}

		$this->validate($request, [
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
		]);

		$user->password = bcrypt($request->get('password'));
		$user->save();

		return redirect('account')
			->with('alert', 'Your password has been changed');

	}

	public function editProfile(Request $request) {

		return view('admin/account/edit-profile', [
			'user' => $request->user(),
		]);
	}

	public function updateProfile(Request $request) {

		# $user = Auth::user(); otra forma d hacerlo
		$user = $request->user();

		$this->validate($request, [
			'name' => 'required|min:2',
		]);

		$user->fill($request->only(
			['name'])
		);

		$user->save();

		return redirect('account')
			->with('alert', 'Your profile has been updated');
	}
}
