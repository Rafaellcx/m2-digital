<?php

namespace App\Providers;


use App\Repositories\CampaignRepository;
use App\Repositories\CityRepository;
use App\Repositories\Contracts\CampaignRepositoryContract;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Repositories\Contracts\DiscountRepositoryContract;
use App\Repositories\Contracts\GroupRepositoryContract;
use App\Repositories\Contracts\ProductCampaignRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\DiscountRepository;
use App\Repositories\GroupRepository;
use App\Repositories\ProductCampaignRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(GroupRepositoryContract::class, GroupRepository::class);
        $this->app->bind(CityRepositoryContract::class, CityRepository::class);
        $this->app->bind(CampaignRepositoryContract::class, CampaignRepository::class);
        $this->app->bind(DiscountRepositoryContract::class, DiscountRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->bind(ProductCampaignRepositoryContract::class, ProductCampaignRepository::class);
    }
}
