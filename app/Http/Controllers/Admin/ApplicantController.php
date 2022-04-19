<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ApplicantsExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\Banner;
use App\Models\Applicant;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ApplicantController extends Controller
{
    use Banner;


    public function __construct()
    {
        $this->authorizeResource(Applicant::class);
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
            'field' => ['in:fname,mname,lname,email,phone_number'],
        ]);

        $college_names = College::latest()->get();
        // $college = DB::table('applicant_college')->where('applicant_id')

        $data = Applicant::with('colleges');

        if (request('search')) {
            $data->where('applicants.id', 'like', '%' . request('search') . '%')
                ->orwhere('applicants.fname', 'like', '%' . request('search') . '%')
                ->orWhere('applicants.mname', 'like', '%' . request('search') . '%')
                ->orWhere('applicants.lname', 'like', '%' . request('search') . '%')
                ->orWhere('applicants.email', 'like', '%' . request('search') . '%')
                ->orWhere('applicants.phone_number', 'like', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $data->orderBy(request('field'), request('direction'))->get();
        }

        return Inertia::render('Admin/Applicant/Index', [
            'applicants' => $data->paginate(25)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction']),
            'college_names' => $college_names
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

        // dd($request['colleges']);
        $val = Validator::make($request->all(), [
            'colleges' => ['required'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:applicants'],
            'phone_number' => ['required', 'integer', 'unique:applicants', 'regex:/^(63)[0-9]{10}$/'],
            'birthday' => ['required', 'date'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $applicant = Applicant::create([
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'birthday' => $request['birthday'],
        ]);

        $colids = [];
        foreach($request['colleges'] as $col){
            array_push($colids, $col['id']);
        }
        $applicant->colleges()->attach($colids);

        $this->flash('Applicant added', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        // dd($request['colleges']);
        $val = Validator::make($request->all(), [
            'colleges' => ['required'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'integer', 'regex:/^(63)[0-9]{10}$/'],
            'birthday' => ['required', 'date'],
        ]);

        if ($val->fails()) {
            $this->flash($val->errors()->first(), 'danger');
            return back();
        }

        $applicant->update([
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'birthday' => $request['birthday'],
        ]);

        // $applicant->colleges()->detach();
        $colids = [];
        foreach($request['colleges'] as $col){
            array_push($colids, $col['id']);
        }

        $applicant->colleges()->sync($colids);

        $this->flash('Applicant updated!', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = Applicant::find($id);
        $d->colleges()->detach();
        $d->delete();

        $this->flash('Applicant removed.', 'success');

        return redirect()->back();
    }

    public function applicantsExport()
    {
        if (request()->has('type')) {
            if (request()->get('type') == 'xlsx') {
                return Excel::download(new ApplicantsExport, auth()->user()->name . '-applicants.xlsx');
            } elseif (request()->get('type') == 'csv') {
                return Excel::download(new ApplicantsExport, auth()->user()->name . '-applicants.csv');
            }
        }

        return back();
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['applicantsExport' => 'applicantsExport']);
    }
}
