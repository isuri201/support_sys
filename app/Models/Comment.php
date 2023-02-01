<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'ticket_id',
        'user_id'
    ];

    public function ticket(){
        return $this->belongsTo(\App\Models\Ticket::class,'ticket_id');
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class,'user_id');
    }
       
    
}
