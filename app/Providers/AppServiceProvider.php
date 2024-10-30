<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\Enums\Placement;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseTableSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

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

        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            DatabaseCheck::new(),
            DatabaseConnectionCountCheck::new(),
            DatabaseTableSizeCheck::new(),
            UsedDiskSpaceCheck::new(),
            QueueCheck::new(),
        ]);
    }
}
