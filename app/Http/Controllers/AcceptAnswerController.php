<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept',$answer);
        $answer->question->acceptBestAnswer($answer);
        if(request()->expectsJson()) {
            return response()->json([
                'message' => "Has aceptado esta respuesta como mejor respuesa"
            ]);
        }
        
        return back();
    }
}
