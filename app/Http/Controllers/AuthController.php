<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\User;

    class AuthController extends Controller
    {
        //
        public function auth (Request $request) {
        	$users = User::get();
        	foreach ($users as $user)
        	{
        		if ($request->input('email') == $user->email && $request->input('password') == $user->password)
        		{
        			return 
        		}
        	}

        }
    }