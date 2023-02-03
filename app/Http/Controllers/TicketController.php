<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketCreated;


class TicketController extends Controller
{

    public function __construct()
{
    
        $this->middleware('auth')->only(['index']);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
      $tickets = Ticket::paginate(5);

      //if search 
        $search = $request->input('search');
        
      if($search){
        $search = $request->search;
        $tickets = Ticket::where('customer_name','LIKE',"%$search%")
                           ->orWhere('phone_number','LIKE',"%$search")->paginate(5);
        
        return view('tickets.all',compact('tickets'));
      }
      //search over

      //sorting
      $sort = $request->input('sort');
        $sort_dir = $request->input('sort_dir');
      if($sort&&$sort_dir){
      $sortColumn = $request->query('sort', 'created_at');
      $sortDir = $request->query('sort_dir') == 'asc' ? 'asc' : 'desc';
      $sortableColumns = [
          'customer_name',
          'created_at',
          'updated_at',
          'status',
      ];
      if (in_array($sortColumn, $sortableColumns)) {
        $tickets = Ticket::orderBy($sortColumn, $sortDir)->paginate(5);

    }
    return view('tickets.all',compact('tickets'));
}

      return view('tickets.all',compact('tickets'));
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
                 Mail::to($ticket->email)->send(new \App\Mail\TicketCreated($ticket));
                return back();
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
        return view('tickets.edit',compact('ticket'));
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
       
        $ticket->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('customer.home'));
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
