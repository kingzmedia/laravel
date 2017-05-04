<?php
namespace Kingzmedia\Comments;

use Illuminate\Support\ServiceProvider;

class CommentsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadViewsFrom(__DIR__.'/../../resources/views', 'comments');

        /*
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/comments'),
        ], 'views');
        */

        /*
        $this->publishes([
            __DIR__.'/../../public' => public_path('vendor/comments'),
        ], 'public');
*/

        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('comments.php'),
        ], 'config');


        /*
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../Http/routes.php';
        }*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__. '/config/config.php', 'comments'
        );

        \Illuminate\Support\Facades\Event::listen("eloquent.saving: Kingzmedia\Comments\Comment", "Kingzmedia\Comments\Listeners\CommentsEventSubscriber@beforeCommentPost");
        \Illuminate\Support\Facades\Event::listen("eloquent.saved: Kingzmedia\Comments\Comment", "Kingzmedia\Comments\Listeners\CommentsEventSubscriber@onCommentPost");


        //\Illuminate\Support\Facades\Event::listen("nique", function($user){  die("OHH LE NIQUERR!"); });

        //event("nique",null,null);
    }






}

