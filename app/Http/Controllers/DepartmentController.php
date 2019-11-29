<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Bank;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::orderBy('id', 'ASC')->paginate(15);
        return view('bank.bank', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, ['name' => 'required', 'admin' => 'required', 'amount' => 'required']);
        Bank::create([
            'name' => $request->input('name'),
            'id_admin' => $request->input('admin'),
            'state' => 1,
            'amount' => $request->input('amount')
        ]);
        Department::create([
            'name' => $request->input('name'),
            'id_admin' => $request->input('admin'),
        ]);
        return redirect('https://palmera.marketing/tokens/department#anchorPoint')->with('success', 'depCS');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, ['name' => 'required', 'admin' => 'required', 'amount' => 'required']);
        $name = Bank::where('id', $id)->value('name');
        Bank::find($id)->update([
            'name' => $request->input('name'),
            'id_admin' => $request->input('admin'),
            'state' => 1,
            'amount' => $request->input('amount'),
        ]);
        $id_D = Department::where('name', $name)->value('id');
        Department::find($id_D)->update([
            'name' => $request->input('name'),
            'id_admin' => $request->input('admin'),
        ]);
        return redirect('https://palmera.marketing/tokens/department#anchorPoint')->with('success', 'depUpS');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $department = Department::where('id', $id)->first();
        $bank = Bank::where('name', $department->name)->first();
        
        $bankAmount = Bank::where('id', 1)->value('amount');
        $newAmount = $bankAmount + $bank->amount;
        Bank::find(1)->update([
            'amount' => $newAmount,    
        ]);
        
        $bank->delete();
        $department->delete();
        return redirect('https://palmera.marketing/tokens/department#anchorPoint')->with('danger','depDelS');
    }
}
