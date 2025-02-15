<?php

use Modules\ProductFeature\Providers\ProductFeatureServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    ProductFeatureServiceProvider::class,
];
