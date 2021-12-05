<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeQtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_qties', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger("product_id")->index();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger("location_id")->index();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('color', 150)->comment('color')->nullable();
            $table->string('size', 150)->comment('size')->nullable();
            $table->string('diemension', 150)->comment('diemension')->nullable();
            $table->string('weight', 150)->comment('weight')->nullable();
            $table->integer('quantity')->default('0')->comment('qty_left');
            $table->integer('qty_left')->default('0')->comment('qty_left');
            $table->double('price',15,2)->default('0')->comment(' price');
            $table->double('cost_price',15,2)->default('0')->comment('cost price');
            $table->double('wholesale_price',15,2)->default('0')->comment('wholesale price');
            $table->double('avg_price',15,2)->default('0')->comment(' price');
            $table->enum('status', ['0', '1'])->default('0')->comment('0 single,1 multiple');
            $table->enum('status1', ['0', '1'])->default('0')->comment('publish status');
            $table->enum('status2', ['0','1', '2','3'])->default('0')->comment('display type');
            $table->date('expire_date')->comment('expire_date')->nullable();
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
        Schema::dropIfExists('product_attribute_qties');
    }
}
