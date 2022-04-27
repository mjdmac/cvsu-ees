<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use App\Http\Traits\Banner;

class QuestionController extends Controller
{
    use Banner;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
       $data = $request->only('exam_id', 'question', 'img_path', 'choices');

        $path = null;
        if ($request->hasFile('img_path')) {
            $path = $request->file('img_path')->store('public/photos');
        }

       $question = Question::create([
           'exam_id' => $data['exam_id'],
           'question' => $data['question'],
           'img_path' => $path,
       ]);

       foreach($data['choices'] as $opt){
        $path1 = null;
        if ($opt['img_path']) {
            $path1 = $opt['img_path']->store('public/photos');
        }
        Choice::create([
            'question_id' => $question->id,
            'option' => $opt['option'],
            'is_correct' => $opt['is_correct'],
            'img_path' => $path1
        ]);
       }

       $this->flash('Question added', 'success');

       return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
