<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Answer;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Answer $answer)
    {
        $vote = (int) request()->vote;

        $votesCount = auth()->user()->voteAnswer($answer, $vote);

        if(request()->expectsJson()) {
            return response()->json([
                'message' => 'Gracias por reaccionar',
                'votescount' => $votesCount
            ]);
        }

        return back();
    }
}
