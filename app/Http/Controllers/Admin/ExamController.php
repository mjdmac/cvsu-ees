<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Banner;
use App\Models\Exam;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    use Banner;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:subject,exam_code,description,duration'],
        ]);

        $data = Exam::query();

        if (request('search')) {
            $data
                ->where('exams.subject', 'like', '%' . request('search') . '%')
                ->orwhere('exams.exam_code', 'like', '%' . request('search') . '%')
                ->orWhere('exams.description', 'like', '%' . request('search') . '%')
                ->orWhere('exams.duration', 'like', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $data->orderBy(request('field'), request('direction'))->get();
        }

        return Inertia::render('Admin/Exam/Index', [
            'exams' => $data->paginate(25)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction']),
        ]);
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
        $val = Validator::make($request->all(), [
            'subject' => ['required'],
            'description' => ['string', 'max:255'],
            'duration' => ['required', 'integer'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $exam_code = IdGenerator::generate(['table' => 'exams', 'field' => 'exam_code', 'length' => 8, 'prefix' => 'EXM-']);

        Exam::create([
            'exam_code' => $exam_code,
            'subject' => Str::of($request['subject'])->ucfirst(),
            'description' => Str::of($request['description'])->ucfirst(),
            'duration' => $request['duration'],
        ]);

        $this->flash('Exam created!', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return Inertia::render('Admin/Exam/Show', [
            'exam' => [
                'id' => $exam->id,
                'subject' => $exam->subject,
                'exam_code' => $exam->exam_code,
                'description' => $exam->description,
                'duration' => $exam->duration,
            ]
        ]);

        
    //     request()->validate([
    //         'direction' => ['in:asc,desc'],
    //         'field' => ['in:subject,exam_code,description,duration'],
    //     ]);

    //     $data = Exam::query();

    //     if (request('search')) {
    //         $data
    //             ->where('exams.subject', 'like', '%' . request('search') . '%')
    //             ->orwhere('exams.exam_code', 'like', '%' . request('search') . '%')
    //             ->orWhere('exams.description', 'like', '%' . request('search') . '%')
    //             ->orWhere('exams.duration', 'like', '%' . request('search') . '%');
    //     }

    //     if (request()->has(['field', 'direction'])) {
    //         $data->orderBy(request('field'), request('direction'))->get();
    //     }

    //     return Inertia::render('Admin/Exam/Show', [
    //         'exam' => $data->paginate(25)->withQueryString(),
    //         'filters' => request()->all(['search', 'field', 'direction']),
    //     ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $val = Validator::make($request->all(), [
            'subject' => ['required'],
            'description' => ['string', 'max:255'],
            'duration' => ['required', 'integer'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $exam->update([
            'subject' => Str::of($request['subject'])->ucfirst(),
            'description' => Str::of($request['description'])->ucfirst(),
            'duration' => $request['duration'],
        ]);

        $this->flash('Exam updated!', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = Exam::find($id);
        $d->delete();

        $this->flash('Exam removed.', 'success');

        return redirect()->route("admin.exams.index");
    }
}
