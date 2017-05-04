<?php
namespace Kingzmedia\Views;

use Illuminate\Support\ServiceProvider;

class ViewsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/config/routes.php';
        $this->app->make('Kingzmedia\Views\Controllers\ViewsController');
    }
}
