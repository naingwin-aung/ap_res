@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content">
            <div class="card shadow-lg rounded-0 p-3 my-3">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr>
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
    $('#table_id').DataTable();
} );
</script>