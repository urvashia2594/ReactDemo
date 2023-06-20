@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Create Exam</h1>
  </div>

  <div class="card-body">
    @include('admin.exam.form',[
    'subject' => $subject,
    'exam' => $exam,
    'route'=>route('admin.exam.store')
    ])
  </div>
  @endsection