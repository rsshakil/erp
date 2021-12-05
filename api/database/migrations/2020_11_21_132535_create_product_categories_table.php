<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('product_group', 350)->comment('category_name')->nullable();
            $table->string('category_name', 350)->comment('category_name')->nullable();
            $table->string('sub_category_name', 350)->comment('sub_category_name')->nullable();
            $table->string('sub_sub_category_name', 350)->comment('sub_category_name')->nullable();
            $table->integer('status')->default('0')->comment('status');
            $table->integer('entry_by')->default('0')->nullable();
            $table->softDeletes();
			$table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Time of creation');
			$table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('Time of Update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
