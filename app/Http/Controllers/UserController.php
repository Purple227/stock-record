<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{
	public function loginGuard() {
		if (Auth::check()) {
    		$user_login = true;
		}else {
			$user_login = false;
		}
		return response()->json($user_login);
	}

}
