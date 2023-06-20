@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Edit Exam</h1>
  </div>

  <div class="card-body">
    @include('admin.exam.form',[
    'subject' => $subject,
    'exam' => $exam,
    'route'=>route('admin.exam.update',$exam)
    ])
  </div>
  @endsection