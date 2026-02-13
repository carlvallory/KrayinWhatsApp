<?php

namespace CarlVallory\KrayinWhatsApp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class KrayinWhatsAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 1. Load Views
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'krayin-whatsapp');

        // 2. Prepend View Path to Override Admin Views
        // We want to override 'admin::components.form.control-group.controls.inline.phone'
        // Krayin loads admin views from 'packages/Webkul/Admin/src/Resources/views'.
        // To override, we prepend our path to the 'admin' namespace.
        
        $this->app['view']->prependNamespace('admin', __DIR__ . '/../Resources/views/overrides/admin');

        // 3. Inject JS Script
        Event::listen('admin.layout.head.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('krayin-whatsapp::whatsapp_script');
        });

        // 4. Inject WhatsApp Action Button to Person Profile
        Event::listen('admin.contact.persons.view.actions.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('krayin-whatsapp::components.actions.whatsapp');
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register any bindings or configs if needed
    }
}
