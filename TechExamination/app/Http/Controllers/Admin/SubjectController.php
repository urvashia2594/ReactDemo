<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Subject;
use Helper;
use DataTables;
use  App\Http\Requests\Admin\Subject\StoreRequest;
use  App\Http\Requests\Admin\Subject\UpdateRequest;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subjects = Subject::query();
            return Datatables::of($subjects)
                ->addColumn('action', function ($row) {

                    $btn = '<a href=' . route("admin.subject.edit", $row->id) . ' class="edit btn btn-primary btn-sm">Edit</a>';

                    $btn .= '<form  action=' . route("admin.subject.destroy", $row->id) . ' method="post">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="submit" class="delete_record" value="Delete">
                            </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.subject.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $subject = new Subject();
        return view('admin.subject.create', ['subject' => $subject]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $this->fillableFields($request);
        $subject = new Subject();
        $subject->fill($data);
        $subject->save();


        // dispatch(new App\Jobs\RegisterUserJob($user));

        return redirect()->route('admin.subject.index')->with('success', 'Subject save successfully');
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
    public function edit(Request $request, Subject $subject)
    {
        return view('admin.subject.edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Subject $subject)
    {
        $data = $this->fillableFields($request);
        $subject->fill($data);
        $subject->save();

        return redirect()->route('admin.subject.index')->with('success', 'Subject update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subject.index')->with('success', 'Subject delete successfully');
    }

    private function fillableFields($request)
    {
        $data = $request->only('name');
        return $data;
    }
}
