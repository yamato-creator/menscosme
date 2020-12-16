<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->comment('adminID');
            $table->string('product_name', 50)->comment('商品名');
            $table->string('bland_name')->nullable()->comment('ブランド名');
            $table->string('item_category')->nullable()->comment('アイテムカテゴリ');
            $table->string('product_image')->nullable()->comment('商品画像');
            $table->string('product_description')->nullable()->comment('商品説明');
            $table->string('price', 50)->nullable()->comment('相場価格');
            $table->string('capacity', 50)->nullable()->comment('容量');
            $table->longText('url')->nullable()->comment('公式ページ');
            $table->timestamps();
            $table->softDeletes();

            $table->index('id');
            $table->index('admin_id');

            $table->foreign('admin_id')
            ->references('id')
            ->on('admins')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
