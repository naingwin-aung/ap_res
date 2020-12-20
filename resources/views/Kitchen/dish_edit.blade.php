@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content">
            <div class="card shadow-lg rounded-0 p-3 my-3">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-header p-3">
                    <h3 class="py-4 pl-3 font-weight-bold d-inline">Dish Edit</h3>
                    <div class="d-flex justify-content-end">
                        <a href="{{url("/dish")}}" class="btn btn-warning">Back</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{url("/dish/$dish->id")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{old('name', $dish->name)}}">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="" selected disabled>Select your dish category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{ $category->id == $dish->category_id ? "selected" : ""}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <img src="{{url('/images/'.$dish->image)}}" alt="" width="150">
                            <div class="input-group my-3">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile02" name="dish_image">
                                  <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose Dish image</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button class="btn btn-primary btn-lg">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  <!-- /.content-wrapper -->
@endsection