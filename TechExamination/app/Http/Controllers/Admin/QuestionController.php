<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Subject;
use  App\Models\question;
use Helper;
use DataTables;
use  App\Http\Requests\Admin\Question\StoreRequest;
use  App\Http\Requests\Admin\Question\UpdateRequest;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $question = Question::with('subject')->whereHas('subject');
            return Datatables::of($question)
                ->addColumn('action', function ($row) {

                    $btn = '<a href=' . route("admin.questions.edit", $row->id) . ' class="edit btn btn-primary btn-sm">Edit</a>';

                    $btn .= '<form  action=' . route("admin.questions.destroy", $row->id) . ' method="post">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="submit" class="delete_record" value="Delete">
                            </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.question.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $question = new question();
        $subject = Subject::pluck('name','id')->toArray();
        return view('admin.question.create', [
            'question' => $question,
            'subject' => $subject
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $this->fillableFields($request);
        $question = new question();
        $question->fill($data);
        $question->save();


        // dispatch(new App\Jobs\RegisterUserJob($user));

        return redirect()->route('admin.questions.index')->with('success', 'Question save successfully');
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
    public function edit(Request $request, question $question)
    {
        $subject = Subject::pluck('name', 'id')->toArray();
        return view('admin.question.edit', [
            'question' => $question,
            'subject' => $subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, question $question)
    {
        $data = $this->fillableFields($request);
        $question->fill($data);
        $question->save();

        return redirect()->route('admin.questions.index')->with('success', 'Question update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Question delete successfully');
    }

    private function fillableFields($request)
    {
        $data = $request->only('subject_id', 'que');
        return $data;
    }
}
