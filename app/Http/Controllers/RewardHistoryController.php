<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wallet;
use App\Bank;
use App\RewardHistory;

class RewardHistoryController extends Controller
{
    //
    public function index()
    {
        //
        $rewards = RewardHistory::orderBy('created_at', 'DESC')->paginate(15);
        return view('reward.reward', compact('rewards'));
    }
    //
    public function create()
    {
        //
    }
    //
    public function store(Request $request)
    {
        //
    }
    //
    public function show($id)
    {
        //
    }
    //
    public function edit($id)
    {
        //
    }
    //
    public function update(Request $request, $id)
    {
        //
    }
    //
    public function destroy($id)
    {
        //
    }
}
