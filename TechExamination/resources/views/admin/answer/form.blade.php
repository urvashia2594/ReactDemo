<form id="user-form" method="POST" action="{{$route}}" enctype="multipart/form-data">
  @csrf
  @if($answer->exists)
  @method('PUT')
  @php $button_lable = 'Update'; @endphp
  @else
  @php $button_lable = 'Submit'; @endphp

  @endif

  <div class="form-group">
    <label for="subject_id">Subject</label>
    {!! Form::select('subject_id', $subject, $answer->subject_id , ['class' => 'form-control select2','placeholder'=>'Please select subject']) !!}
  </div>

  <div class="form-group">
    <label for="subject_id">Question</label>
    {!! Form::select('question_id', $question, $answer->subject_id , ['class' => 'form-control select2','placeholder'=>'Please select question']) !!}
  </div>

  <div class="form-group">
    <label for="opption_1">opption 1</label>
    <input type="text" name="opption_1" id="opption_1" value="{{old('opption_1',$answer->opption_1)}}" class="form-control" />
  </div>

  <div class="form-group">
    <label for="opption_2">opption 2</label>
    <input type="text" name="opption_2" id="opption_2" value="{{old('opption_2',$answer->opption_2)}}" class="form-control" />
  </div>

  <div class="form-group">
    <label for="opption_3">opption 3</label>
    <input type="text" name="opption_3" id="opption_3" value="{{old('opption_3',$answer->opption_3)}}" class="form-control" />
  </div>

  <div class="form-group">
    <label for="opption_4">opption 4</label>
    <input type="text" name="opption_4" id="opption_4" value="{{old('opption_4',$answer->opption_1)}}" class="form-control" />
  </div>

  <div class="form-group">
    <label for="correct_answer">Answer</label>
    <input type="text" name="correct_answer" id="correct_answer" value="{{old('correct_answer',$answer->correct_answer)}}" class="form-control" />
  </div>

  <div class="form-group">
    <button type="submit" class="form-control">{{$button_lable}}</button>
  </div>
</form>