<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_campaign', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('products_campaign', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::table('products_campaign', function (Blueprint $table) {
            $table->unsignedBigInteger('campaign_id');

            $table->foreign('campaign_id')->references('id')->on('campaigns');
        });

        Schema::table('products_campaign', function (Blueprint $table) {
            $table->unique(['product_id', 'campaign_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_campaign', function (Blueprint $table) {
            $table->dropForeign('products_campaign_product_id_foreign');
        });

        Schema::table('products_campaign', function (Blueprint $table) {
            $table->dropForeign('products_campaign_campaign_id_foreign');
        });

        Schema::table('products_campaign', function (Blueprint $table) {
            $table->dropUnique(['product_id', 'campaign_id']);
        });

        Schema::dropIfExists('products_campaign');
    }
}
