<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswersController extends Controller
{
    public function __invoke(Answer $answer) {
        
        $this->authorize('accept', $answer);

        $answer->question->acceptBestAnswer($answer);

        if(request()->expectsJson()) {
            return response()->json([
                'message' => 'You have acccepted this answer as best'
            ]);
        }
        return back();
        
    }
}
