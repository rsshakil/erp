<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_controls', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [ '1','2','3'])->default('1')->comment('1product2bannner3right_image');
            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('image', 350)->comment('image')->nullable();
            $table->string('image_rect', 350)->comment('image')->nullable();
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
        Schema::dropIfExists('image_controls');
    }
}
