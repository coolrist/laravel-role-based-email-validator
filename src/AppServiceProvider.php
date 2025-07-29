<?php

namespace Coolrist\RoleBasedEmailValidator;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the Role Based Email Validator package.
 * Registers a custom validation rule to prevent role-based email addresses.
 */
class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any package services.
     * This method is used for tasks that need to be run after all other service providers have been registered (e.g., publishing assets, loading routes, migrations).
     */
    public function boot() {
        // Publish the configuration file for the package
        $this->publishes([
            __DIR__ . '/../config/role_based.php' => config_path('role_based.php'),
        ], 'coolrist-role-based-config');

        // Register the validation rule for role-based email addresses
        RoleBasedEmailValidator::validate();
    }

    /**
     * Register any package services.
     * This method is used to bind things into the service container.
     * For configuration, it's typically used to merge default config.
     */
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/../config/role_based.php', 'role_based');
    }

}
