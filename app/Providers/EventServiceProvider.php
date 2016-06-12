<?php

namespace App\Providers;

use App\Anotacao;
use App\Atividade;
use App\Aula;
use App\Observers\AnotacaoObserver;
use App\Observers\AtividadeObserver;
use App\Observers\AulaObserver;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Aula::observe(new AulaObserver());
        Atividade::observe(new AtividadeObserver());
        Anotacao::observe(new AnotacaoObserver());
        //
    }
}
