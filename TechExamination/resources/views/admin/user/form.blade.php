<form id="user-form" method="POST" action="{{$route}}" enctype="multipart/form-data">
  @csrf
  @if($user->exists)
  @method('PUT')
  @php $button_lable = 'Update'; @endphp
  @else
  @php $button_lable = 'Submit'; @endphp

  @endif
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{old('name',$user->name)}}" />
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="{{old('email',$user->email)}}" />
  </div>


  <div class="form-group">
    <label for="password">Password</label>
    <input type="text" name="password" id="password" value="" />
  </div>

  <div class="form-group">
    <button type="submit">{{$button_lable}}</button>
  </div>
</form>