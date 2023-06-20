@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Create User</h1>
  </div>

  <div class="card-body">
    @include('admin.user.form',[
    'user'=>$user,
    'route'=>route('admin.user.store')
    ])
  </div>
  @endsection