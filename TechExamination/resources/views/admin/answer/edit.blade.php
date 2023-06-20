@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Edit Answer</h1>
  </div>

  <div class="card-body">
    @include('admin.answer.form',[
    'answer' => $answer,
    'subject' => $subject,
    'question' => $question,
    'route'=>route('admin.answer.update',$answer)
    ])
  </div>
  @endsection