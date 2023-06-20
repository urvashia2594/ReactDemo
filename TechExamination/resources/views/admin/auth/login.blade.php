@extends('admin.layout.login')



@section('section')
  @include('global.showflash')

  <div class="card">
    <div class="card-header text-center font-weight-bold">
      Login
    </div>
    <div class="card-body">
      <form name="login_form" id="login_form" method="post" action="{{route('admin.login')}}">
       @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="text" id="email" name="email" class="form-control" value="{{old('email ')}}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Password</label>
          <input type="password" id="password" name="password" class="form-control" value="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
@endsection

