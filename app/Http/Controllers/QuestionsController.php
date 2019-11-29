<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::get();
        return view('evaluation.evaluation', compact('questions'));
        //
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
        $this->validate($request, ['question' => 'required', 'description' => 'required', 'icon' => 'required']);
        $question = Question::create([
            'question' => $request->input('question'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon'),
            'state' => 1,
        ]);
        
        return redirect('https://palmera.marketing/tokens/administrator')->with('success', 'questionRS');

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
        $this->validate($request, ['question' => 'required', 'description' => 'required', 'icon' => 'required']);

        Question::find($id)->update([
            'question' => $request->input('question');
            'description' => $request->input('description');
            'icon' => $request->input('icon');
        ]);

        return redirect('https://palmera.marketing/tokens/administrator')->with('danger', 'questionUS');
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
        Question::find($id)->update([
            'state' => 2,
        ]);
        return redirect('https://palmera.marketing/tokens/administrator')->with('success', 'questionDS');
    }
}
