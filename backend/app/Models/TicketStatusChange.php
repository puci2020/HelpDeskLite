<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketStatusChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'previous_status',
        'new_status',
        'changed_by',
    ];

    /*
     |--------------------------------------------------------------------------
     |   Relationships
     |--------------------------------------------------------------------------
     */

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
