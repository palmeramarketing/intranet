<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = Group::orderBy('id', 'ASC')->paginate(15);
        $users = User::get();
        return view('groups.groups', compact('users', 'groups'));
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
        $this->validate($request, ['name' => 'required', 'admin' => 'required',]);
        $users = $request->input('users');
        Group::create([
            'name' => $request->input('name'),
            'admin' => intval($request->input('admin')),
            'users' => json_encode($users),
        ]);

        return \Redirect::back()->with('success', 'workGroupCS');
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
        $this->validate($request, ['name' => 'required', 'admin' => 'required', 'users' => 'required']);
        Group::find($id)->update([
            'name' => $request->input('name'),
            'admin' => $request->input('admin'),
            'users' => $request->input('users'),
        ]);
        return \Redirect::back()->with('success', 'workGroupUpS');
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
        Group::find($id)->delete();
        return \Redirect::back()->with('danger', 'workGroupDelS');
    }
}
