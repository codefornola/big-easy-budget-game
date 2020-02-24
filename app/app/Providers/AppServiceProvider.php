<?php

namespace App\Providers;

use Config;
use App\Models\Account;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'admin.sections.sidebar', 'App\Http\ViewComposers\NavbarComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->setupOauthRedirects();

    }

    public function setupOauthRedirects()
    {

        foreach(['facebook', 'google', 'twitter'] as $service)
        {
            Config::set("services.$service.redirect", url("/$service/login"));
        }

    }

}
