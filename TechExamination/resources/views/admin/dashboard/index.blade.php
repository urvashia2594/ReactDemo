@extends('admin.layout.main')


@section('section')
  @include('global.showflash')
  <div class="card">
    <div class="card-header text-center font-weight-bold">
      Welcome {{\Auth::user()->name}}
    </div>
  </div>
@endsection

