<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Wallet;
use App\Notifications\NewUserRegistered;
use App\Bank;
use App\Department;

class UserController extends Controller
{
    public function index()
    {
        //
        $departments = Department::get();
        $users = User::orderBy('id', 'DESC')->paginate(15);
        return view('users.users', compact('users', 'departments'));
    }
    public function create()
    {
        //
    }
    public function registerRequest (Request $request) {
        //
    }
    public function registerAccepted () {
        //
    }
    public function registerRejected () {
        //
    }
    public function store(Request $request)
    {
        //
        $this->validate($request, ['name' => 'required', 'last_name' => 'required', 'email' => 'required', 'type' => 'required', 'department' => 'required', 'password' => 'required']);
        
        $email = $request->input('email');
        $usersC = User::get();
        
        function findEmail($usersC, $email)
        {
            foreach($usersC as $userC)
            {
                if($userC->email == $email)
                {
                    return true;
                    break;
                }
                else
                {
                    //
                }
            }
        }
        
        $findEmail = findEmail($usersC, $email);
        
        if($findEmail == true)
        {
            //
            return \Redirect::back()->with('danger','userEIU');
        }
        else
        {
            $password = $request->input('password');
            $hashed = Hash::make($password);
    
            $user = User::create([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'type' => intval($request->input('type')),
                'department' => $request->input('department'),
                'password' => $hashed,
            ]);
            $id = User::where('email', $request->input('email'))->value('id');
            Wallet::create([
                'id_user' => $id,
                'state' => 1,
                'amount' => 0,
            ]);
            $admins = User::where('type', '2')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewUserRegistered($user));
            }
            $sus = User::where('type', '3')->get();
            foreach ($sus as $su) {
                $su->notify(new NewUserRegistered($user));
            }
            return \Redirect::back()->with('success','userRS');
        }
    }
    public function show($id)
    {
        //
        $departments = Department::get();
        $user = User::where('id', $id)->first();

        return view('users.userPage', compact('user', 'departments'));
        
    }
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, ['name' => 'required', 'last_name' => 'required', 'email' => 'required','type' => 'required', 'department' => 'required']);
        $email = $request->input('email');
        $usersC = User::get();
        
        function findEmail($usersC, $email, $id)
        {
            foreach($usersC as $userC)
            {
                if($userC->email == $email)
                {   
                    if(User::where('id', $id)->value('email') == $email)
                    {
                        //
                    }
                    else
                    {
                        return true;
                        break;
                    }
                }
                else
                {
                    //
                }
            }
        }
        
        $findEmail = findEmail($usersC, $email, $id);
        
        if($findEmail == true)
        {
            //
            return \Redirect::back()->with('danger','userEIU');
        }
        else
        {
            User::find($id)->update([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'type' => $request->input('type'),
                'department' => $request->input('department'),
            ]);
            // return \Redirect::back()->with('success','userUpS');
            return redirect('https://palmera.marketing/tokens/user#anchorPoint')->with('success', 'userUpS');
        }
    }
    public function imgUpdate(Request $request)
    {
        $this->validate($request, ['img' => 'required']);
        $img = $request->file('img');
        $img_name = $img->getClientOriginalName();
        $img->move('public/avatar', $img_name);
        $id = $request->input('id');
        User::find($id)->update([
            'img' => $img_name,
        ]);
        return \Redirect::back()->with('success', 'userIPUp');
    }
    public function password(Request $request, $id)
    {
        //
        $this->validate($request, ['password' => 'required', 'passwordConfirm' => 'required']);
        if ($request->input('password') == $request->input('passwordConfirm'))
        {
            $password = $request->input('password');
            $hashed = Hash::make($password);
            User::find($id)->update([
                'password' => $hashed,
            ]);
            return \Redirect::back()->with('success','userPUpS');
        }
    }
    public function passwordReset($id)
    {
        $password = '12345';
        $hashed = Hash::make($password);
        User::find($id)->update([
            'password' => $hashed,    
        ]);
        // return \Redirect::back()->with('success','userPRS');
        return redirect('https://palmera.marketing/tokens/user#anchorPoint')->with('success', 'userPRS');
    }
    public function destroy($id)
    {
        //
        $walletUser = Wallet::where('id_user', $id)->value('amount');
        $bankAmount = Bank::where('id', 1)->value('amount');
        $newAmount = $bankAmount + $walletUser;
        Bank::find(1)->update([
            'amount' => $newAmount,    
        ]);
        Wallet::where('id_user', $id)->delete();
        User::find($id)->delete();
        // return \Redirect::back()->with('danger','userDelS');
        return redirect('https://palmera.marketing/tokens/user#anchorPoint')->with('danger', 'userDelS');
    }
}
