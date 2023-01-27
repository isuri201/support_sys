@extends('layouts.app')

@section('content')
<div class="container">


  <div class="card mt-5">
   <div class="card-title">
      <h3>Ticket Details</h3>
   </div>
  
  <table class="table table-striped">
   <tbody>
      <tr>
         <th>Name:</th>
         <td>{{$ticket->customer_name}}</td>
      </tr>
      <tr>
         <th>Email:</th>
         <td>{{$ticket->email}}</td>
      </tr>
      <tr>
         <th>Phone Number:</th>
         <td>{{$ticket->phone_number}}</td>
      </tr>
      <tr>
         <th>Problem:</th>
         <td>{{$ticket->description}}</td>
      </tr>
      <tr>
         <th>Created At:</th>
         <td>{{$ticket->created_at}}</td>
      </tr>
   </tbody>
  </table>
</div>
 

</div>
@endsection
