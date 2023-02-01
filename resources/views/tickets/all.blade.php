@extends('layouts.app')

@section('content')
<div class="container">
<form class="" action="{{route('tickets.index')}}" method="post">
    @method('get')
    @csrf
        <div class="row">
            <div class="col-3">
                <select class="form-control" name="sort">
                    <option value="customer_name">Customer Name</option>
                    <option value="created_at">Opened Time</option>
                    <option value="updated_at">Last Updated Time</option>
                    <option value="status">Status</option>
                </select>
            </div> 
             <div class="col-3">
                <select class="form-control" name="sort_dir">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" name="search" value="" class="form-control mb-5" placeholder="Reference, customer name or phone number">
            </div>
            <div class="col-2">
                <button type="submit" name="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>
    <table class="table">
    
<thead>
    <tr>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Opened Date</th>
        <th>Handled By</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    
    @foreach($tickets as $ticket)
    <tr>
        <td>{{$ticket->customer_name}}</td>
        <td>{{$ticket->email}}</td>
        <td>{{$ticket->phone_number}}</td>
        <td>{{$ticket->created_at}}</td>
        <td>
        @if($ticket->comments->isNotEmpty())
        @foreach($ticket->comments as $comment)
        @if(isset($comment->user))
        {{$comment->user->name}}
        @break
        @endif
        @endforeach
        @endif
        </td>
        <td>{{$ticket->status}}</td>
    </tr>
     
    @endforeach
   
</tbody>

    </table>
    {!! $tickets->links() !!}
</div>
@endsection