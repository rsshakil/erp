<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('country', 150)->comment('name')->nullable();
            $table->string('region', 150)->comment('name')->nullable();
            $table->string('district', 150)->comment('name')->nullable();
            $table->string('area', 150)->comment('name')->nullable();
            $table->string('branch', 150)->comment('name')->nullable();
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
        Schema::table('branch_controls', function(Blueprint $table)
        {
            $table->dropForeign('branch_controls_client_id_foreign'); 
        });
        Schema::dropIfExists('branch_controls');
    }
}
