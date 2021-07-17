<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept',$answer);

        $answer->question->acceptBestAnswer($answer);

        return response()->json([
            'message' => "Has aceptado esta respuesta como mejor respuesta"
        ]);
    }
}
