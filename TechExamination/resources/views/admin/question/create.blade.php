@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <h1>Create Question</h1>
  </div>

  <div class="card-body">
    @include('admin.question.form',[
    'question' => $question,
    'subject' => $subject,
    'route'=>route('admin.questions.store')
    ])
  </div>
  @endsection