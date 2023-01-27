@extends('layouts.app')

@section('content')
<div class="container">
<div class="card text-center mt-5 ">
  <div class="card-header bg-warning">
    Online Support System
  </div>
  <div class="card-body bg-light">
    <h5 class="card-title">Get Your Support Here</h5>
    <p class="card-text">We are ready to assist you online in any technical problem</p>
    <a href="{{route('tickets.create')}}" class="btn btn-dark">Get the support</a>
  </div>
  <div class="card-footer text-muted bg-warning">
   
  </div>
</div>
<div class="row mt-5">
<div class="row row-cols-1 row-cols-md-2">
  <div class="col mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Check out your problem solutions</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card">
      <div class="card-body">
      @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <h5 class="card-title">View your problem ticket details opened recently</h5>
        <form action="{{route('search')}}" method="post">
          @method('get')
        <input type="text" class="form-control" name="ref" placeholder="Enter your reference number"> <input type="submit" class="btn btn-info mt-3" value="search your ticket">
        </form>
      
      </div>
    </div>
  </div>
</div>
</div>
</div>

@endsection