<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;

use App\Http\Resources\ExamResource;
use App\Http\Resources\QuestionResource;

use App\Http\Requests\Api\SubmitExamRequest;
use  App\Models\UserExam;
use  App\Models\UserExamQueAns;
use Exception;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $page;
    public function __construct()
    {
        $this->page = config('params.page_siez');
    }


    public function index(Request $request)
    {
        $page = ($request->has('page_size') && $request->get('page_size') != '') ? $request->get('page_size') :$this->page;

        $exam = Exam::with('subject')->whereHas('subject')->simplePaginate($page);

        return ExamResource::collection($exam);
    }

    public function questionListFromExamId(Request $request, Exam $exam)
    {
        $page = ($request->has('page_size') && $request->get('page_size') != '') ? $request->get('page_size') : $this->page;

        $exam = Question::with('subject', 'answer')
                        ->whereHas('subject')
                        ->whereHas('answer')
                        ->where('subject_id', $exam->subject_id)
                        ->simplePaginate($page);

        return QuestionResource::collection($exam);
    }

    public function checkUserAbilty(Request $request)
    {
        $user = $request->user();

        $check_attempt_for_exam = UserExam::where('user_id', $user->id)->where('exam_id', $request->exam_id)->first();

        $can_able = ($check_attempt_for_exam)?'N':'Y';

        return response()->json(['can_user_able' => $can_able],200);
    }

    //Noyte : - user cat attempt only 1 time exam 
    public function submitExam(SubmitExamRequest $request)
    {
        try
        {
            
            $user = $request->user();

            $check_attempt_for_exam = UserExam::where('user_id', $user->id)->where('exam_id', $request->exam_id)->first();

            $user_exam = new UserExam();
            $user_exam->user_id  = $user->id;
            $user_exam->exam_id   = $request->exam_id;
            $user_exam->total_attempt   = 1;
            $user_exam->save();

            //save user exam question and answer

            $exam = $request->exam;

            foreach($exam as $key=>$value)
            {
                $answer = Answer::where('id',$value['answer_id'])->first();
                $User_exam_que_ans =  new UserExamQueAns();
                $User_exam_que_ans->user_exam_id  =
                $user_exam->id;
                $User_exam_que_ans->user_id =
                $user->id;
                $User_exam_que_ans->exam_id =
                $request->exam_id;
                $User_exam_que_ans->question_id =
                $value['question_id'];
                $User_exam_que_ans->answer_id =
                $value['answer_id'];
                $User_exam_que_ans->user_answer =
                $value['selected_anser'];
                $User_exam_que_ans->correct_answer =
                $answer->correct_answer;
                $User_exam_que_ans->save();
            }

            //return result ;
            $get_user_exam = $user->userEaxm()
                            ->whereHas('userEaxmQueAns')
                            ->where('id',$user_exam->id)
                            ->first();
            
            $user_que_ans_incorrect_count = $get_user_exam->userEaxmQueAns()
                                            // ->whereColumn('user_answer', 'correct_answer')
                                            ->whereColumn('user_answer', '!=', 'correct_answer')
                                            ->count();
            
            $final_result = $get_user_exam->userEaxmQueAns()->count() - $user_que_ans_incorrect_count;

            $resposne['total_question'] = $get_user_exam->userEaxmQueAns()->count();
            $resposne['correct_answer_score'] = $final_result;
             $resposne['wrong_answer_score'] = $user_que_ans_incorrect_count;


            return response()->json(['success' => 1, 'data' => $resposne],200);
            

            //send in meail
            //send in meail



        }
        catch(Exception $e)
        {
            Log::info('error during submit exam');
            Log::error($e->getMessage());
            return response()->json(['success' => 0,'error' => 'Something went wrong'], 500);
        }
       

    }



   
}
