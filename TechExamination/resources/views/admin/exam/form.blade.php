<form id="user-form" method="POST" action="{{$route}}" enctype="multipart/form-data">
  @csrf
  @if($exam->exists)
  @method('PUT')
  @php $button_lable = 'Update'; @endphp
  @else
  @php $button_lable = 'Submit'; @endphp

  @endif

  <div class="form-group">
    <label for="subject_id">Subject</label>
    {!! Form::select('subject_id', $subject, $exam->subject_id , ['class' => 'form-control select2','placeholder'=>'Please select subject']) !!}
  </div>

  <div class="form-group">
    <label for="name">Exam</label>
    <input type="text" name="name" id="name" value="{{old('exam',$exam->name)}}" class="form-control" />
  </div>

  <div class="form-group">
    <label for="name">Attempt</label>
    <input type="number" name="attempt" id="attempt" value="{{old('attempt',$exam->attempt)}}" class="form-control" />
  </div>

  <div class="form-group">
    <button type="submit" class="form-control">{{$button_lable}}</button>
  </div>
</form>