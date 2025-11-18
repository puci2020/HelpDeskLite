<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'reporter_id',
        'assignee_id',
    ];

    protected $appends = [
        'created_at_formatted',
        'updated_at_formatted',
    ];


    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_ticket');
    }

    public function statusChanges()
    {
        return $this->hasMany(TicketStatusChange::class);
    }

    public function getCreatedAtFormattedAttribute(): string
    {
        return $this->created_at->format('d-m-Y H:i');
    }

    public function getUpdatedAtFormattedAttribute(): string
    {
        return $this->updated_at->format('d-m-Y H:i');
    }
}
