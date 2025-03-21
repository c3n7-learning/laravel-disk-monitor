<?php

namespace Tefabi\DiskMonitor;

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tefabi\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Tefabi\DiskMonitor\Http\Controllers\DiskMetricsController;

class DiskMonitorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('disk-monitor')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_disk_monitor_entries_table')
            ->hasCommand(RecordDiskMetricsCommand::class);
    }

    public function packageRegistered()
    {
        Route::macro('diskMonitor', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/', DiskMetricsController::class);
            });
        });
    }
}
