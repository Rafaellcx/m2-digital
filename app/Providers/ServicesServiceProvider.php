<?php

namespace App\Providers;

use App\Services\CampaignService;
use App\Services\CityService;
use App\Services\Contracts\CampaignServiceContract;
use App\Services\Contracts\CityServiceContract;
use App\Services\Contracts\DiscountServiceContract;
use App\Services\Contracts\GroupServiceContract;
use App\Services\Contracts\ProductCampaignServiceContract;
use App\Services\Contracts\ProductServiceContract;
use App\Services\DiscountService;
use App\Services\GroupService;
use App\Services\ProductCampaignService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(GroupServiceContract::class, GroupService::class);
        $this->app->bind(CityServiceContract::class, CityService::class);
        $this->app->bind(CampaignServiceContract::class, CampaignService::class);
        $this->app->bind(DiscountServiceContract::class, DiscountService::class);
        $this->app->bind(ProductServiceContract::class, ProductService::class);
        $this->app->bind(ProductCampaignServiceContract::class, ProductCampaignService::class);
    }
}
