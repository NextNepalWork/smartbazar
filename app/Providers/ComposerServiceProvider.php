<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['partials.header'], 'App\Http\ViewComposers\MenuListComposer'
        );

        view()->composer(
            [
                'vendor.harimayco-menu.menu-html',
                'admin.layouts.app',
                'partials.header',
                'layouts.app',
                'partials.footer',
                'front.index',
                'front.category.category_collection'

            ], 'App\Http\ViewComposers\ProductCategoryListComposer'
        );
        view()->composer([
            'partials.header'
        ], 'App\Http\ViewComposers\ServiceListComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
