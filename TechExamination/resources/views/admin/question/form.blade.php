<form id="user-form" method="POST" action="{{$route}}" enctype="multipart/form-data">
  @csrf
  @if($question->exists)
  @method('PUT')
  @php $button_lable = 'Update'; @endphp
  @else
  @php $button_lable = 'Submit'; @endphp

  @endif

  <div class="form-group">
    <label for="subject_id">Subject</label>
    {!! Form::select('subject_id', $subject, $question->subject_id , ['class' => 'form-control select2','placeholder'=>'Please select subject']) !!}
  </div>

  <div class="form-group">
    <label for="que">Question</label>
    <input type="text" name="que" id="que" value="{{old('que',$question->que)}}" class="form-control" />
  </div>

  <div class="form-group">
    <button type="submit" class="form-control">{{$button_lable}}</button>
  </div>
</form>