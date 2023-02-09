@auth
@extends('layouts.app')
@endauth

@guest
@extends('layouts.customer_app')
@endguest

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
      <tr>
         @guest
         <th><a href="{{route('tickets.edit',$ticket->id)}}" class="btn btn-warning">update</a></th>
         <th><td> <form action="{{route('tickets.destroy',$ticket->id)}}" method="post">
                @csrf
                @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
            </form></td></th>
         @endguest
         </tr>
   </tbody>
  </table>
</div>
 <div class="row">
   <div class="col-md-6">
   <form action="{{route('comments.store')}}" method="post">
   @csrf
   <textarea class="form-control mt-5" placeholder="Type your reply" name="content"></textarea>
   </div>
<div class="col-md-4">
   <input type="hidden" name="ticket_id" value="{{$ticket->id}}">       
<input type="submit" class="btn btn-success mt-5" value="Reply">
</div>
</form>
 </div>
 @if($ticket->comments->isNotEmpty())
<div class="comments">
    @foreach($ticket->comments as $comment)
    <div class="comment mt-5">
        <div class="comment-author text-muted small">
            <strong>
            
                  @if(isset($comment->user->name))
                  {{$comment->user->name}}
              @else
                  {{ $ticket->customer_name }}
              @endif
            </strong>
            at
            {{ $comment->created_at->format('d M Y h:i a') }}
        </div>
        <div class="comment-content">
            {{ $comment->content }}
        </div>
    </div>
    @endforeach
</div>
@endif
@auth
<div class="row mt-5">
@if($ticket->status!=3)
   <div class="col-2">
   <form action="{{route('tickets.update',$ticket->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="2">
            <input type="submit" value="resolved" class="btn btn-success">
        </form>
   </div>

     <div class="col-2">
     <form action="{{route('status.update',$ticket->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="3">
            <input type="submit" value="cancel" class="btn btn-danger">
        </form>
     </div>  
     @endauth 
        @endif
</div>
 
</div>

@endsection
