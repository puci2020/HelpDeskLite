<?php

namespace App\Providers;

use App\Exceptions\Handler;
use App\Repositories\Eloquent\TicketRepository;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Services\Auth\Interfaces\UserApiServiceInterface;
use App\Services\Auth\UserApiService;
use App\Services\Ticket\Interfaces\TicketServiceInterface;
use App\Services\Ticket\TicketService;
use App\Services\Triage\Interfaces\TriageServiceInterface;
use App\Services\Triage\MockTriageService;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TicketRepositoryInterface::class,
            TicketRepository::class
        );
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
        $this->app->bind(TriageServiceInterface::class, MockTriageService::class);
        $this->app->bind(UserApiServiceInterface::class, UserApiService::class);
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
