@extends('layouts.app')

@section('content')
<div class="container">
<form class="" action="{{route('tickets.index')}}" method="post">
    @method('get')
    @csrf
        <div class="row">
            <div class="col-3">
                <select class="form-control" name="sort">
                    <option value="customer_name" {{ request('sort', 'customer_name') == 'customer_name' ? 'selected' : null }} >Customer Name</option>
                    <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : null }}>Opened Time</option>
                    <option value="updated_at" {{ request('sort', 'updated_at') == 'updated_at' ? 'selected' : null }}>Last Updated Time</option>
                    <option value="status" {{ request('sort', 'status') == 'status' ? 'selected' : null }} >Status</option>
                </select>
            </div> 
             <div class="col-3">
                <select class="form-control" name="sort_dir">
                    <option value="asc" {{ request('sort_dir', 'asc') == 'asc' ? 'selected' : null }} >Ascending</option>
                    <option value="desc" {{ request('sort_dir', 'desc') == 'desc' ? 'selected' : null }} >Descending</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control mb-5" placeholder="Reference, customer name or phone number">
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
        <!-- <td> -->
        <!-- @if($ticket->comments->isNotEmpty())
        @foreach($ticket->comments as $comment)
        @if(isset($comment->user))
        {{$comment->user->name}}
        @break
        @endif
        @endforeach
        @endif -->
        <td>{{ $ticket->lastCommentedAgent ? $ticket->lastCommentedAgent->name : 'None' }}</td>

        <!-- </td> -->
        <td>
            @if($ticket->status == 0)
            <div class="badge badge-info" >New</div>
            @elseif($ticket->status == 1)
            <div class="badge badge-warning" >Attended</div>
            @elseif($ticket->status == 2)
            <div class="badge badge-success" >Resloved</div>
            @else
            <div class="badge badge-danger" >Cancelled</div>
            @endif
        </td>
        
        @if($ticket->status !=2 && $ticket->status != 3)
        <td><a href="{{route('tickets.show',$ticket->id)}}" class="btn btn-info">View</a></td>
        @endif
    </tr>
     
    @endforeach
   
</tbody>

    </table>
    {!! $tickets->links() !!}
</div>
@endsection