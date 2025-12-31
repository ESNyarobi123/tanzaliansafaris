<?php

namespace App\Providers;

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
        if (app()->runningInConsole()) {
            return;
        }

        try {
            if (\Schema::hasTable('site_settings')) {
                $settings = \App\Models\SiteSetting::all();
                
                // Mail Settings
                $mailSettings = [
                    'mail_host' => 'mail.mailers.smtp.host',
                    'mail_port' => 'mail.mailers.smtp.port',
                    'mail_username' => 'mail.mailers.smtp.username',
                    'mail_password' => 'mail.mailers.smtp.password',
                    'mail_encryption' => 'mail.mailers.smtp.encryption',
                    'mail_from_address' => 'mail.from.address',
                    'mail_from_name' => 'mail.from.name',
                ];

                foreach ($mailSettings as $key => $configKey) {
                    $setting = $settings->where('key', $key)->first();
                    if ($setting && $setting->value) {
                        config([$configKey => $setting->value]);
                    }
                }

                // General Settings
                $siteName = $settings->where('key', 'site_name')->first();
                if ($siteName && $siteName->value) {
                    config(['app.name' => $siteName->value]);
                }
            }
        } catch (\Exception $e) {
            // Silently fail if DB is not ready
        }
    }
}
