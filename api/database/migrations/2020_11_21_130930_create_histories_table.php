<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->index();
            $table->foreign('user_id')->references('id')->on('users'); 
           $table->enum('type',['call','meeting','visite'])->default('visite')->comment('type');
           $table->text('message', 350)->comment('full_name')->nullable();
           $table->date('appointment_date')->comment('appointment_date')->nullable();
           $table->date('flowup_date')->comment('flowup_date')->nullable();
           $table->integer('status')->default('0')->nullable();
           $table->integer('executed_by')->default('0')->nullable();
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
        Schema::dropIfExists('histories');
    }
}
