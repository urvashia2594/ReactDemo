@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Edit User</h1>
  </div>

  <div class="card-body">
    @include('admin.user.form',[
    'user'=>$user,
    'route'=>route('admin.user.update',$user)
    ])
  </div>
  @endsection