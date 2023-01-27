<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'customer_name'=>'required',
            'email'=>'required',
            'description'=>'required'
        ]);

    //generating the reference id of the customer
    $id = DB::table('tickets')->max('id');
    $date = date('Y');
    $ref = $id.$date;
    //end generating the ref id 

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $ticket = new Ticket();
            $ticket->customer_name = $request->input('customer_name');
            $ticket->phone_number = $request->input('phone_number');
            $ticket->email = $request->input('email');
            $ticket->description = $request->input('description');
            $ticket->ref = $ref;
            $ticket->status = 0;
            if($ticket->save()){
                return back()->with('success','Your Problem ticket sent successfully');
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function search(Request $request){
        $ref = $request->ref;
         $ticket = Ticket::where('ref',$ref)->first();
         if($ticket){
          return view ('tickets.show',compact('ticket'));
         }
          
       return redirect()->back()->with('error', 'Sorry! We could not find the ticket you are looking for. Please check the reference number.');
      }
}
