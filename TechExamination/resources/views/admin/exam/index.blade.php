@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <a href="{{route('admin.exam.create')}}">Add Exam</a>
  </div>

  <div class="card-body">
    <table id="example" class="table table-striped data-table" style="width:100%">
      <thead>
        <tr>
          <th>id</th>
          <th>Subject</th>
          <th>Exam</th>
          <th>Attempt</th>
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
        ajax: "{{ route('admin.exam.index') }}",
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'subject.name',
            name: 'subject.name',
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'attempt',
            name: 'attempt'
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