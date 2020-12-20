@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content">
            <div class="card shadow-lg rounded-0 p-3 my-3">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif

                <div class="card-header p-3">
                    <h3 class="py-4 pl-3 font-weight-bold d-inline">Dishes</h3>
                    <div class="d-flex justify-content-end">
                        <a href="{{url("/dish/create")}}" class="btn btn-success">Create</a>
                    </div>
                </div>
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Dish order code</th>
                            <th>Dish Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dishes as $key => $dish)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$dish->name}}</td>
                                <td>{{$dish->category->name}}</td>
                                <td>
                                    <a href="{{url("/dish/$dish->id/edit")}}" class="btn btn-outline-primary">Edit</a>
                                    <form action="{{url("/dish/$dish->id")}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete dish!');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  <!-- /.content-wrapper -->
@endsection

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready( function () {
    $('#table_id').DataTable({
    });
} );
</script>