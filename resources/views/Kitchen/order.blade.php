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
                    <h3 class="py-4 pl-3 font-weight-bold d-inline">Today Orders</h3>
                </div>
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Dish Name</th>
                            <th>Table Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{$order->dish->name}}</td>
                                <td>{{$order->table->number}}</td>
                                <td>{{$status[$order->status]}}</td>
                                <td>
                                    <a href="{{url("/orders/$order->id/approve")}}" class="btn btn-outline-primary">Approve</a>
                                    <a href="{{url("/orders/$order->id/cancle")}}" class="btn btn-outline-danger">Cancle</a>
                                    <a href="{{url("/orders/$order->id/ready")}}" class="btn btn-outline-success">Ready</a>
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
      "searching" : false,
    });
} );
</script>