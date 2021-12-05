<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_controls', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['1', '2'])->default('1')->comment('1manufac2brand');
            $table->string('name', 80)->comment('name')->nullable();
            $table->integer('status')->default('0')->nullable();
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
        Schema::dropIfExists('type_controls');
    }
}
