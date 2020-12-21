<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<style>
    .order {
        text-decoration: none;
        font-size: 30px;
    }
    .order:hover {
        text-decoration: none;
    }
</style>
<body>
    <div class="container my-5">
        <div class="card p-3 border-0 shadow">
            @if (session('order-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('order-success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <div class="card-header mb-3">
            <a href="{{url('/')}}" class="font-weight-bold order">Order Form</a>

                <form action="" method="POST" class="pt-4">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="searchkey" placeholder="search">
                        <div class="input-group-append">
                          <button type="submit" class="input-group-text">search</button>
                        </div>
                      </div>
                    </div>
                </form>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">New Order</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Order List</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <form action="{{route('order.submit')}}" method="POST">
                    @csrf
                    <div class="row">

                        {{-- @if (request()->searchkey)
                            {{$dishes = $searchdish}}
                        @endif --}}

                        @foreach (request()->searchkey ? $searchdish : $dishes as $dish)
                            <div class="col-3">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <img src="{{url('images/'.$dish->image)}}" alt="" width="200" height="200">
                                        <p class="font-weight-bold mt-3 text-primary">{{$dish->name}}</p>
                                    </div>
                                    <input type="number" name="{{$dish->id}}" class="form-control">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <select name="table" id="" class="form-control">
                            <option value="" selected disabled>Choose table number</option>
                            @foreach ($tables as $table)
                                <option value="{{$table->id}}">{{$table->number}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary btn-block py-3 font-weight-bold">Order Now</button>
                </form>

                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Dish Name</th>
                                <th>Table Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->dish->name}}</td>
                                    <td>{{$order->table->number}}</td>
                                    <td>{{$status[$order->status]}}</td>
                                    <td>
                                        <a href="{{url("/orders/$order->id/serve")}}" class="btn btn-outline-primary">Serve</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>