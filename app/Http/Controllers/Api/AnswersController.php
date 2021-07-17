<?php

namespace App\Http\Controllers\Api;

use App\Models\Answer;
use App\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AnswerResource;

class AnswersController extends Controller
{
    public function index(Question $question)
    {
        $answers = $question->answers()->with('user')->where(function ($q) {
            if(request()->has('excludes')) {
                $q->whereNotIn('id', request()->query('excludes'));
            }
        })->simplePaginate(3);

        return AnswerResource::collection($answers);
    }

    public function store(Question $question,Request $request)
    {
        $answer = $question->answers()->create($request->validate([
            'body' => 'required'
        ]) + ['user_id' => \Auth::id()]);

        return response()->json([
            'message' => "Tu respuesta ha sido enviada correctamente",
            'answer' => $answer->load('user')
        ]);
    }

    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);

        $answer->update($request->validate([
            'body' => 'required',
        ]));

        return response()->json(['message' => 'Tu respuesta ha sido actualizada','body_html' => $answer->body_html]);
    }


    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete',$answer);

        $answer->delete();

        return response()->json(['message' => 'Tu respuesta ha sido eliminada']);
    }
}
