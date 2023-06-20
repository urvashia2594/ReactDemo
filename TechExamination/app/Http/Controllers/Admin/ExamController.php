<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Subject;
use  App\Models\Exam;
use Helper;
use DataTables;
use  App\Http\Requests\Admin\Exam\StoreRequest;
use  App\Http\Requests\Admin\Exam\UpdateRequest;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $exam = Exam::with('subject')->whereHas('subject');
            return Datatables::of($exam)
                ->addColumn('action', function ($row) {

                    $btn = '<a href=' . route("admin.exam.edit", $row->id) . ' class="edit btn btn-primary btn-sm">Edit</a>';

                    $btn .= '<form  action=' . route("admin.exam.destroy", $row->id) . ' method="post">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="submit" class="delete_record" value="Delete">
                            </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.exam.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $exam = new Exam();
        $subject = Subject::pluck('name', 'id')->toArray();
        return view('admin.exam.create', [
            'subject' => $subject,
            'exam' => $exam
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $this->fillableFields($request);
        $exam = new Exam();
        $exam->fill($data);
        $exam->save();


        // dispatch(new App\Jobs\RegisterUserJob($user));

        return redirect()->route('admin.exam.index')->with('success', 'Exam save successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Exam $exam)
    {
        $subject = Subject::pluck('name', 'id')->toArray();
        return view('admin.exam.edit', [
            'subject' => $subject,
            'exam' => $exam
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Exam $exam)
    {
        $data = $this->fillableFields($request);
        $exam->fill($data);
        $exam->save();

        return redirect()->route('admin.exam.index')->with('success', 'Exam update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Exam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exam.index')->with('success', 'Exam delete successfully');
    }

    private function fillableFields($request)
    {
        $data = $request->only('subject_id', 'name', 'attempt');
        return $data;
    }
}
