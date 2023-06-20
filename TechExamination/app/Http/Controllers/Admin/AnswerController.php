<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Answer;
use  App\Models\question;
use  App\Models\Subject;
use Helper;
use DataTables;
use  App\Http\Requests\Admin\Answer\StoreRequest;
use  App\Http\Requests\Admin\Answer\UpdateRequest;


class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $answer = Answer::with('subject', 'question')->whereHas('subject')->whereHas('question');
            return Datatables::of($answer)
                ->addColumn('action', function ($row) {

                    $btn = '<a href=' . route("admin.answer.edit", $row->id) . ' class="edit btn btn-primary btn-sm">Edit</a>';

                    $btn .= '<form  action=' . route("admin.answer.destroy", $row->id) . ' method="post">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="submit" class="delete_record" value="Delete">
                            </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.answer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $answer = new Answer();
        $subject = Subject::pluck('name', 'id')->toArray();
        $question = question::get()->pluck('sub_with_que', 'id')->toArray();
        
        return view('admin.answer.create', [
            'answer' => $answer,
            'subject' => $subject,
            'question' => $question
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $this->fillableFields($request);
        $answer = new Answer();
        $answer->fill($data);
        $answer->save();


        // dispatch(new App\Jobs\RegisterUserJob($user));

        return redirect()->route('admin.answer.index')->with('success', 'Answer save successfully');
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
    public function edit(Request $request, Answer $answer)
    {
        $subject = Subject::pluck('name', 'id')->toArray();
        $question = question::get()->pluck('sub_with_que', 'id')->toArray();

        return view('admin.answer.edit', [
            'answer' => $answer,
            'subject' => $subject,
            'question' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Answer $answer)
    {
        $data = $this->fillableFields($request);
        $answer->fill($data);
        $answer->save();

        return redirect()->route('admin.answer.index')->with('success', 'Answer update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Answer $answer)
    {
        $answer->delete();
        return redirect()->route('admin.answer.index')->with('success', 'Answer delete successfully');
    }

    private function fillableFields($request)
    {
        $data = $request->only('subject_id', 'question_id', 'opption_1', 'opption_2', 'opption_3', 'opption_4', 'correct_answer');
        return $data;
    }
}
