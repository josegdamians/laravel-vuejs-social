<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $questions = Question::with("user")->latest()->paginate(5);

        return view('questions.index',compact('questions'));
    }

    public function create()
    {
        $question = new Question();

        return view('questions.create',compact('question'));
    }

    public function store(\App\Http\Requests\AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->validated());

        return redirect()->route('questions.index')->with('success','Tu pregunta ha sido enviada correctamente');
    }

    public function show(Question $question)
    {
        $question->increment('views');

        return view('questions.show',compact('question'));
    }

    public function edit(Question $question)
    {
        $this->authorize("update",$question);

        return view('questions.edit',compact('question'));
    }

    public function update(\App\Http\Requests\AskQuestionRequest $request, Question $question)
    {
        $this->authorize("update",$question);

        $question->update($request->validated());

        if($request->expectsJson()) 
        {
            return response()->json([
                'message' => "Tu pregunta ha sido actualizada correctamente",
                'body_html' => $question->body_html
            ]);
        }

        return redirect()->route('questions.index')->with('success','Tu pregunta ha sido actualizada correctamente');
    }

    public function destroy(Question $question)
    {
        $this->authorize("delete",$question);

        $question->delete();

        if(request()->expectsJson())
        {
            return response()->json([
                'message' => "Tu pregunta ha sido eliminada correctamente",
            ]);
        }

        return redirect()->route('questions.index')->with('success','Tu pregunta ha sido eliminada correctamente');
    }
}