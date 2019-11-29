<?php

namespace App\Http\Controllers;

use Illuminate\Database\Migrations\Migrations;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\EvaluationHistory;
use App\User;
use App\Evaluation;
use App\Question;



class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::get();
        $questions = Question::get();
        return view('evaluation.evaluation', compact('users', 'questions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        set_time_limit(120);
        Schema::create('evaluations', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->integer('id_evaluator')->unsigned()->nullable;
            $table->boolean('evaluated');
            $table->integer('id_question');
            $table->float('value', 4, 2);
            $table->timestamps();
        });
        $users = User::get();
        $questions = Question::get();
        foreach($users as $user)
        {
            //
            foreach($questions as $question)
            {
                //
                if($user->type == 2)
                {
                    //
                    foreach ($users as $su)
                    {
                        //
                        if($su->type == 3 && $su->id == 1)
                        {
                            //
                            Evaluation::create([
                                'id_user' => $user->id,
                                'id_evaluator' => $su->id,
                                'evaluated' => 0,
                                'id_question' => $question->id,
                                'value' => 0, 
                            ]);
                        }
                        else
                        {
                            //
                        }
                    }
                }
                elseif($user->type == 1)
                {
                    //
                    foreach($users as $admin)
                    {
                        //
                        if($admin->type == 2 && $admin->department == $user->department)
                        {
                            //
                            Evaluation::create([
                                'id_user' => $user->id,
                                'id_evaluator' => $admin->id,
                                'evaluated' => 0,
                                'id_question' => $question->id,
                                'value' => 0, 
                            ]);
                        }
                        else
                        {
                            //
                        }
                    } 
                }
                elseif($user->type == 3)
                {
                    //
                }
                else
                {
                    //
                }
            }
        }
        return \Redirect::back()->with('success', 'evaluationCreated');        
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
        $evaluations = Evaluation::get();
        $id_user = $request->input('id_user');
        $id_evaluator = $request->input('id_evaluator');
        $questions = Question::get();
        foreach($evaluations as $evaluation)
        {
            if($evaluation->id_user == $id_user && $evaluation->id_evaluator == $id_evaluator)
            {
                switch ($evaluation->id_question)
                {
                    case '1':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question1'),
                        ]);
                        break;
                    case '2':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question2'),
                        ]);                    
                        break;
                    case '3':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question3'),
                        ]);
                        break;
                    case '4':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question4'),
                        ]);
                        break;
                    case '5':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question5'),
                        ]);
                        break;
                    case '6':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question6'),
                        ]);
                        break;
                    case '7':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question7'),
                        ]);
                        break;
                    case '8':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question8'),
                        ]);
                        break;
                    case '9':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question9'),
                        ]);
                        break;
                    case '10':
                        //
                        Evaluation::find($evaluation->id)->update([
                            'evaluated' => 1,
                            'value' => $request->input('question10'),
                        ]);
                        break;
                    default:
                        //
                        break;
                }
                User::find($evaluation->id_user)->update([
                    'evaluated' => 1,
                ]);
            }
        }
        return \Redirect::back()->with('success', 'userEvalS');
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
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $evaluation = Evaluation::get();
        $saveEvaluation = json_encode($evaluation);
        EvaluationHistory::create([
            'date' => date('m-Y'),
            'data' => $saveEvaluation,            
        ]);
        Schema::dropIfExists('evaluations');
        return \Redirect::back()->with('danger', 'evaluationRemoved');
    }
}
