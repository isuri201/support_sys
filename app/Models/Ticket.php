<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'phone_number',
        'email',
        'description',
        'ref',
        'status'

    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getLastCommentedAgentAttribute()
{
    return $this->comments->sortByDesc('created_at')
        ->whereNotNull('user')->pluck('user')->first();
}
}
