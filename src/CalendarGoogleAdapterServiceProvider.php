<?php

namespace InEngine\CalendarGoogleAdapter;

use InEngine\CalendarGoogleAdapter\Commands\CalendarGoogleAdapterCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CalendarGoogleAdapterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('calendar-google-adapter')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_calendar_google_adapter_table')
            ->hasCommand(CalendarGoogleAdapterCommand::class);
    }
}
