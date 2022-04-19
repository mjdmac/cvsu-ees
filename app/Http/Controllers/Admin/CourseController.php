<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Banner;
use App\Models\College;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CourseController extends Controller
{
    use Banner;

    public function __construct()
    {
        $this->authorizeResource(Course::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:course_name,course_desc'],
        ]);

        $colleges = College::latest()->get();

        // $data = Course::with('college')->where(function($q){
        //     if (request('search')) {
        //         $q->where('course_name', 'like', '%' . request('search') . '%')
        //             ->orWhere('course_desc', 'like', '%' . request('search') . '%');
        //              //->orWhere('college_name', 'like', '%' . request('search') . '%');
        //            // ->orWhere(\DB::raw('colleges.college_name', 'like', '%' . request('search') . '%'));
        //     }
        // })->whereHas('college', function($q) {
        //     if(request('search')){
        //         $q->where('college_name', 'like', '%' . request('search') . '%');
        //     }
        // })
        // ->join('colleges', 'courses.college_id', '=', 'colleges.id')
        //     ->select(\DB::raw('*'));

        $data = Course::with('college')
            ->select(\DB::raw('*'));

        if (request('search')) {
            $data
                ->join('colleges', 'courses.college_id', '=', 'colleges.id')
                ->where('courses.course_name', 'like', '%' . request('search') . '%')
                ->orWhere('courses.course_desc', 'like', '%' . request('search') . '%')
                ->orWhere('colleges.college_name', 'like', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $data->orderBy(request('field'), request('direction'))->get();
        }

        return Inertia::render('Admin/Course/Index', [
            'courses' => $data->paginate(25)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction']),
            'colleges' => $colleges,
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
            'college' => ['required'],
            'course_name' => ['required', 'string', 'max:255', 'unique:courses'],
            'course_desc' => ['required', 'string', 'max:255'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        Course::create([
            'college_id' => $request['college']['id'],
            'course_name' => $request['course_name'],
            'course_desc' => $request['course_desc'],
        ]);

        $this->flash('Course added', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
       
        $val = Validator::make($request->all(), [
            'college' => ['required'],
            'course_name' => ['required', 'string', 'max:255'],
            'course_desc' => ['required', 'string', 'max:255'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $course->update([
            'college_id' => $request['college']['id'],
            'course_name' => $request['course_name'],
            'course_desc' => $request['course_desc'],
        ]);

        $this->flash('Course updated successfully.', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = Course::find($id);
        $d->delete();

        $this->flash('Course removed.', 'success');

        return redirect()->back();
    }
}
