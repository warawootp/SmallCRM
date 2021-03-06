<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Key management</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customers.index') }}">Customer</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('keys.index') }}">Key</span></a>
            </li>
        </ul>
    </nav>
    <form class="p-3" action="{{ route('keys.store') }}" method="post">
        @csrf
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Api Key</span>
            </div>
            <input type="text" class="form-control" id="key" name="key" value="">
            <div class="input-group-append">
                <!-- TODO: When user click save, save key into database -->
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

    @if ($errors->count() > 0)
    <div class="alert alert-danger" role="alert">
        @foreach( $errors->all() as $message )
          <li>{{ $message }}</li>
        @endforeach
    </div>
    @endif
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Key</th>
                <th class="w-25"></th>
            </tr>
        </thead>
        <!-- TODO: List key from database -->
        @foreach($keys as $key)
        <tr>
            <td>{{$key->apikey}}</td>
            <td>
                <!-- TODO: Delete key from database -->
                <form action="keys/{{$key->id}}" method="post" onsubmit="return confirm('Do you want to delete this api key!');">
                  @csrf
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-sm btn-secondary">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
