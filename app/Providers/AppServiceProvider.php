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
        //Response macros for pnotify
        RedirectResponse::macro('pnotify', function($title = '', $text = '', $type = 'success'){
            session()->flash('pnotify.title', $title);
            session()->flash('pnotify.type', $type);
            session()->flash('pnotify.text', $text);
            return $this;
        });

        //permisions directives
        \Blade::directive('permission', function($expression) {
            return "<?php if (auth()->user()->hasPerm({$expression})) : ?>";
        });
        \Blade::directive('endpermission', function($expression) {
            return "<?php endif; ?>";
        });
    }
}
