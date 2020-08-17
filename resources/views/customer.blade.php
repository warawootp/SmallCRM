<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Customer management</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('customers.index') }}">Customer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('keys.index') }}">Key</span></a>
            </li>
        </ul>
    </nav>

    <form class="p-3" action="{{ route('customers.store') }}" method="post">
        @csrf
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Customer</span>
            </div>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="">
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="">
            <div class="input-group-append">
                <!-- TODO: When user click save, save customer firstname and lastname into database -->
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
                <th>First name</th>
                <th>Last name</th>
                <th class="w-25"></th>
            </tr>
        </thead>
        <!-- TODO: List customer from database -->
        @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->firstname }}</td>
            <td>{{ $customer->lastname }}</td>
            <td>
                <!-- TODO: After click edit, populate first name, last name on to form above for editing -->
                <div class="input-group">
                  <form class="inline" action="/customers/{{$customer->id}}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal fade" id="modalEditForm{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Edit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                              <label>Firstname</label>
                              <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="{{$customer->firstname}}">
                            </div>

                            <div class="md-form mb-4">
                              <label>Lastname</label>
                              <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="{{$customer->lastname}}">
                            </div>

                          </div>
                          <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-secondary">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <button type="submit" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalEditForm{{$customer->id}}">Edit</button>

                  <span>&nbsp;</span>
                  <!-- TODO: Delete customer from database -->
                  <form action="/customers/{{$customer->id}}" method="post" onsubmit="return confirm('Do you want to delete this customer!');">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-sm btn-secondary">Delete</button>
                  </form>
              </div>
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
