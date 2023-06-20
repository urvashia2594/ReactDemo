<form id="user-form" method="POST" action="{{$route}}" enctype="multipart/form-data">
  @csrf
  @if($subject->exists)
  @method('PUT')
  @php $button_lable = 'Update'; @endphp
  @else
  @php $button_lable = 'Submit'; @endphp

  @endif
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{old('name',$subject->name)}}" />
  </div>

  <div class="form-group">
    <button type="submit">{{$button_lable}}</button>
  </div>
</form>