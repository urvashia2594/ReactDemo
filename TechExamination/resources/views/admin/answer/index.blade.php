@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <a href="{{route('admin.answer.create')}}">Add Answer</a>
  </div>

  <div class="card-body">
    <table id="example" class="table table-striped data-table" style="width:100%">
      <thead>
        <tr>
          <th>id</th>
          <th>Subject</th>
          <th>Question</th>
          <th>Answer</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  @endsection

  @section('custom-script')

  <script type="text/javascript">
    $(function() {

      var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.answer.index') }}",
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'subject.name',
            name: 'subject.name',
          },
          {
            data: 'question.que',
            name: 'question.que',
          },
          {
            data: 'correct_answer',
            name: 'correct_answer'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          },
        ]
      });

    });
  </script>
  @include('global.delete');
  @endsection