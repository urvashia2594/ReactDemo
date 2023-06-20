@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Create Subject</h1>
  </div>

  <div class="card-body">
    @include('admin.subject.form',[
    'subject'=>$subject,
    'route'=>route('admin.subject.store')
    ])
  </div>
  @endsection