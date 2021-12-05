<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image', 350)->comment('image')->nullable();
            $table->string('image_web', 350)->comment('image_web')->nullable();
            $table->string('title', 350)->comment('title')->nullable();

            $table->string('lang', 350)->default('en')->comment('lang')->nullable();
            $table->string('currency', 350)->comment('lang')->nullable();
            $table->string('timezone', 350)->comment('lang')->nullable();

            $table->string('full_name', 350)->comment('full_name')->nullable();
            $table->string('contact_person_name', 350)->comment('contact_person')->nullable();
            $table->string('contact_person_mobile', 350)->comment('contact_person')->nullable();
            $table->string('warehouse', 350)->comment('warehouse')->nullable();
            $table->date('dob')->comment('dob')->nullable();
            $table->double('credit_limit',11,2)->comment('credit_limit')->nullable();
            $table->string('address1', 350)->comment('address1')->nullable();
            $table->string('address2', 350)->comment('address2')->nullable();
            $table->string('city', 350)->comment('address2')->nullable();
            $table->string('country', 350)->comment('address2')->nullable();
            $table->string('phone', 350)->comment('address2')->nullable();
            $table->string('mobile', 350)->comment('address2')->nullable();
            $table->double('total_sales', 11,2)->comment('amount')->nullable();
            $table->double('total_payments', 11,2)->comment('amount')->nullable();
            $table->double('installments', 11,2)->comment('amount')->nullable();
            $table->double('balance', 11,2)->comment('amount')->nullable();
            $table->enum('type', ['Client','Customer','Outlet','Dealer','Vendor','Partner','Loan','LoanR','AdvanceG','AdvanceVAT','AdvanceTAX','AdvanceR','General','Specialist','Patient','Student'])->default('Customer')->comment('employee type');
            $table->string('sub_type', 350)->comment('sub_type')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0inactive1active');
            $table->integer('contact_owner')->default('0')->nullable();
            $table->integer('entry_by')->default('0')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
