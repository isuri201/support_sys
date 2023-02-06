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
        @if($ticket->status!=3)
        <td><form action="{{route('tickets.update',$ticket->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="2">
            <input type="submit" value="resolved" class="btn btn-success">
        </form></td>
        <td><form action="{{route('tickets.update',$ticket->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="3">
            <input type="submit" value="cancel" class="btn btn-danger">
        </form></td>
        @endif
    </tr>
     
    @endforeach
   
</tbody>

    </table>
    {!! $tickets->links() !!}
</div>
@endsection