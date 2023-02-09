<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Events\TicketEmail;
use App\Mail\TicketCreated;

class TicketsController extends Controller
{
    public function store(Request $request){

        $validator = validator::make($request->all(),[
            'customer_name'=>'required',
            'email'=>'required',
            'description'=>'required'
        ]);

        $data = $request->only([
            'customer_name',
            'email',
            'phone_number',
            'description'
        ]);

        //generating the reference id of the customer
    $id = DB::table('tickets')->max('id');
    $date = date('Y');
    $ref = $id.$date;
    //end generating the ref id 
    $data['ref'] = $ref;
    $data['status'] = 0;

    $ticket = Ticket::create($data);

    if ($ticket) {
        // dispatch the TicketCreated event
        // \App\Events\TicketEmail::dispatch($ticket);

        return response()->json([
            'data' => $ticket,
            'message' => 'Your ticket is created successfully. Please write down the reference number to check the ticket status later.'
        ]);
    }

    return response()->json([
        'data' => null,
        'message' => 'Oops! Could not create your ticket. Please try later.'
    ], 500);

    }

   public function index(){
    $ticket = Ticket::all();
    return $ticket;
   }

}
