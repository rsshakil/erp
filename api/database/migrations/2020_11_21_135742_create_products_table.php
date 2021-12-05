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
            $table->id();
            
            $table->unsignedBigInteger("group_id")->index();
            $table->foreign('group_id')->references('id')->on('product_categories');

            $table->unsignedBigInteger("category_id")->index();
            $table->foreign('category_id')->references('id')->on('product_categories');

            $table->unsignedBigInteger("sub_category_id")->index();
            $table->foreign('sub_category_id')->references('id')->on('product_categories');

            $table->unsignedBigInteger("sub_sub_category_id")->index();
            $table->foreign('sub_sub_category_id')->references('id')->on('product_categories');
            $table->unsignedBigInteger("brand_id")->index();
            $table->foreign('brand_id')->references('id')->on('type_controls');
            $table->unsignedBigInteger("manufacturer_id")->index();
            $table->foreign('manufacturer_id')->references('id')->on('type_controls');

			$table->string('product_code', 30)->comment('p code')->nullable();
			$table->string('barcode', 36)->comment('barcode')->nullable();
            $table->string('product_name', 350)->comment('p name')->nullable();
            $table->string('unit', 50)->comment('unit')->nullable();
            $table->string('image', 350)->comment('image')->nullable();
            $table->string('image_rect', 350)->comment('image')->nullable();
            $table->longText('product_description')->comment('product_description')->nullable();
            $table->string('warrranty', 350)->comment('warrranty')->nullable();
            
            $table->text('product_includes')->comment('product_includes')->nullable();
            $table->string('protfolio', 350)->comment('protfolio')->nullable();
            $table->enum('product_type', ['Retail', 'FnB','Service','Raw','Asset','Stationery'])->default('Retail')->comment('product type');

           
            $table->integer('min_qty')->nullable()->comment('min_qty');
            
            $table->double('discount',15,2)->default('0')->comment(' discount');
            $table->string('tax_group',50)->comment(' tax_group')->nullable();
            $table->enum('publish_status', ['0', '1'])->default('0')->comment('publish status');
            $table->enum('display_status', ['0','1', '2','3'])->default('0')->comment('display type');
            $table->string('prodcut_image', 240)->comment('Image of product')->nullable();
            $table->text('instruction_list')->comment('instruction_list')->nullable();
            $table->text('review_list')->comment('review_list')->nullable();
            $table->text('support_list')->comment('support_list')->nullable();
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
        Schema::dropIfExists('products');
    }
}
