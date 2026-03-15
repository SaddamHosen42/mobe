<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Native\Laravel\Facades\Window;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        $this->useProjectDatabaseConnection();

        Window::open();
    }

    protected function useProjectDatabaseConnection(): void
    {
        if (! config('nativephp-internal.running')) {
            return;
        }

        $projectConnection = env('NATIVEPHP_DB_CONNECTION', env('DB_CONNECTION', 'mysql'));

        if (! config("database.connections.{$projectConnection}")) {
            return;
        }

        config(['database.default' => $projectConnection]);
        config(['queue.failed.database' => $projectConnection]);
        config(['queue.batching.database' => $projectConnection]);
        config(['queue.connections.database.connection' => $projectConnection]);

        DB::purge();
        DB::reconnect();
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
