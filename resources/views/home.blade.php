@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All New Tickets') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                   <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->customer_name}}</td>
                        <td>{{$ticket->email}}</td>
                        <td>{{date('Y-m-d',strtotime($ticket->created_at))}}</td>
                        <td><a href="{{route('tickets.show',$ticket->id)}}" class="btn btn-success" >View</a></td>
                        
                    </tr>
                    @endforeach
                   </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
