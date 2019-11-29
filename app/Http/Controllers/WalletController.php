<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OperationsHistory;
use App\RewardHistory;
use App\Wallet;
use App\User;
use App\Bank;
use App\Notifications\NewRequestReward; 

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        $this->validate($request, ['from' => 'required', 'to' => 'required', 'amount' => 'required', 'description' => 'required']);
        
        $amount_to_debt = Wallet::where('id_user', $request->input('from'))->value('amount');
        $amount_to_credit = Wallet::where('id_user', $request->input('to'))->value('amount');
        
        $amount_debt = $amount_to_debt - $request->input('amount');
        $amount_credit = $amount_to_credit + $request->input('amount');
        
        $debt = Wallet::where('id_user', $request->input('from'))->first();
        $credit = Wallet::where('id_user', $request->input('to'))->first();

        $debt->amount = $amount_debt;
        $credit->amount = $amount_credit;

        $debt->save();
        $credit->save();
        
        OperationsHistory::create([
            'from_user' => $request->input('from'),
            'to_user' => $request->input('to'),
            'amount' => $request->input('amount'),
            'state' => 1,
            'description' => $request->input('description'),
        ]);
        return \Redirect::back()->with('success', 'payRS');
    }
    public function rewardRequest(Request $request)
    {
        //
        $reward = RewardHistory::create([
            'from_admin' => $request->input('from'),
            'to_user' => $request->input('to'),
            'amount' => $request->input('amount'),
            'state' => 1,
            'description' => $request->input('description'),
        ]);
        $user = User::where('name', 'JC')->first();
        $user->notify(new NewRequestReward($reward));
        return \Redirect::back()->with('success','requestSS');
    }
    public function rejectReward(Request $request)
    {
        //
    }
    public function payReward(Request $request)
    {
        
        $this->validate($request, ['from' => 'required', 'to' => 'required', 'amount' => 'required', 'description' => 'required']);
        
        $amount_to_debt = Bank::where('id_admin', $request->input('from'))->value('amount');
        $amount_to_credit = Wallet::where('id_user', $request->input('to'))->value('amount');
        
        $amount_debt = $amount_to_debt - $request->input('amount');
        $amount_credit = $amount_to_credit + $request->input('amount');
        
        $debt =  Bank::where('id_admin', $request->input('from'))->first();
        $credit = Wallet::where('id_user', $request->input('to'))->first();

        $debt->amount = $amount_debt;
        $credit->amount = $amount_credit;

        $debt->save();
        $credit->save();
        
        RewardHistory::create([
            'from_admin' => $request->input('from'),
            'to_user' => $request->input('to'),
            'amount' => $request->input('amount'),
            'state' => 1,
            'description' => $request->input('description'),
        ]);
        return \Redirect::back()->with('success', 'rewardAS');
        
    }
    public function show($id)
    {
        //
        // $product = Product::where('id', $id)->first();
        return view('reward.rewardPage');
    }
}
