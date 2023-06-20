@extends('admin.layout.main')


@section('section')
@include('global.showflash')
<div class="card">
  <div class="card-header">
    <a href="{{route('admin.subject.create')}}">Add Subject</a>
  </div>

  <div class="card-body">
    <table id="example" class="table table-striped data-table" style="width:100%">
      <thead>
        <tr>
          <th>id</th>
          <th>Name</th>
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
        ajax: "{{ route('admin.subject.index') }}",
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'name',
            name: 'name'
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