@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Edit Subject</h1>
  </div>

  <div class="card-body">
    @include('admin.subject.form',[
    'subject'=>$subject,
    'route'=>route('admin.subject.update',$subject)
    ])
  </div>
  @endsection