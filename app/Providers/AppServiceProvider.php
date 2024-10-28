<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\Enums\Placement;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->displayLocale('en')
                ->locales(['en','id'])
                ->visible(outsidePanels: true)
                ->outsidePanelPlacement(Placement::TopLeft)
                ->flags([
                    'en' => asset('images/flags/united-states.svg'),
                    'id' => asset('images/flags/indonesia.svg'),
                ])
                ->circular();
        });
    }
}
