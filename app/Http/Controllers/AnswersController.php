<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function _construct() {
        $this->middleware('auth')->except('index');
    }
    
    public function index(Question $question) {
        return $question->answers()->with('user')->simplePaginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
            ]);

        $answer = $question->answers()->create(['body' => $request->body, 'user_id' => \Auth::id()]);

        if($request->expectsJson()) {
            return response()->json([
                'message' => 'Answer has been created',
                'answer' => $answer->load('user')
            ]);
        }

        return back()->with('success', "Your answer has been created");
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([ 'body' => 'required']));

        

        if($request->expectsJson()) {
            return response()->json([
                "message" => 'Your answer has been updated',
                'body' => $answer->body
            ]);
        }

        return redirect()->route('questions.show', $question->slug)->with('success', "Your answer has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        if(request()->expectsJson()) {
            return response()->json([
                "message" => 'Your answer has been deleted',
            ]);
        }

        return redirect()->back()->with("success", "Your answer has been deleted");

    }
}
