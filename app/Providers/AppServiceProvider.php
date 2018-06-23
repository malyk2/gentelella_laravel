<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\RedirectResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        RedirectResponse::macro('pnotify', function($title = '', $text = '', $type = 'success'){
            session()->flash('pnotify.title', $title);
            session()->flash('pnotify.type', $type);
            session()->flash('pnotify.text', $text);
            return $this;
        });
    }
}
