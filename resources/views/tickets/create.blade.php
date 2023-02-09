@extends('layouts.customer_app')

@section('content')
<div class="container">
<div class="card mt-5 ">

  <div class="card-header bg-secondary">
    <h3 class="text-white text-center">Online Support Form</h3>
  </div>
  <div class="card-body bg-light">
  <form action="{{route('tickets.store')}}" method="post">
  @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
  @if ($errors->any())
     <div class='alert alert-danger'>
        <ul>
            @foreach ($errors->all() as $error )
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
  @endif

    @csrf
    <div>
    <div class="form-group row">
        <label for="name">Name</label>
        <input type="text" name="customer_name" id="name" class="form-control">
    </div>
    <div class="form-group row">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group row">
        <label for="phone">Contact Number</label>
        <input type="text" name="phone_number" id="phone" class="form-control">
    </div>
    <div class="form-group row">
        <label for="description">Your Problem</label>
        <textarea name="description" id="description" cols="100" rows="10" placeholder="Type your problem Here.." class="form-control"></textarea>
    </div>
</div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Send">
    </div>
</form>
  </div>
  <div class="card-footer text-muted bg-secondary">

  </div>
</div>
</div>

@endsection
