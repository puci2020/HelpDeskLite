<?php

namespace App\Providers;

use App\Events\TicketStatusChanged;
use App\Listeners\LogTicketStatusChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TicketStatusChanged::class => [
            LogTicketStatusChange::class,
        ],
    ];
}
