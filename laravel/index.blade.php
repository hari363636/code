@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Area</h1>
        <span><a class="btn btn-primary" href="{{route('area.add')}}">Add</a></span>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item">Area</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Area</h5>

              <table class="table" id="area-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Area Name</th>
                        <th scope="col">Area Name : Arabic</th>
                        <th scope="col">Governorate</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if(isset($sizes) && !empty($sizes))
                      @foreach($sizes as $key => $size)
                        <tr>
                          <th scope="row">{{ $key + 1 }}</th>
                          <td>{{$size->area}}</td>
                          <td>{{$size->arabic}}</td>
                          <td>{{$size->governorate}}</td>
                          <td>
                            <a href="{{ route('area.edit', ['id' => $size->id]) }}" class="btn btn-primary"> <i class="fa fa-pen"></i> </a>
                            <a href="javascript:;" class="btn btn-danger delete-size" data-id="{{ $size->id }}"> <i class="fa fa-trash"></i> </a>

                          </td>
                        </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">

$(".delete-size").click(function() {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            var id = $(this).data("id");
            var token = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("area.destroy") }}',
                method: "POST",
                data: {
                    _token: token,
                    id: id
                },
                success: function() {

                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Area has been deleted.',
                        icon: 'success',
                    }).then((data) => {
                        location.reload();
                    });
                }
            });
        }
    });
});

</script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script type="text/javascript">


$(document).ready(function () {
    $("#area-table").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

</script>
@endsection
