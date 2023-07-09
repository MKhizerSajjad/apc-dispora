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
            $table->enum('status',['Active', 'Dormant', 'Inactive','Expired'])->default('Active');
            $table->integer('user_type')->default(2); // admin, customer
            $table->enum('title',['Mr', 'Mrs', 'Miss','Doctor'])->default('Mr');
            $table->string('first_name', 20);
            $table->string('last_name', 15);
            $table->string('picture')->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->enum('emergency_relation',['Husband', 'Wife', 'Partner','Father','Mother','Sister','Brother','Friend','Colleague'])->default('Friend');
            $table->string('emergency_name', 80)->nullable();
            $table->string('emergency_number', 20)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('occupation')->nullable();
            $table->string('party_position')->nullable();
            $table->string('branch')->nullable();
            $table->string('chapter')->nullable();
            $table->string('membership_type')->nullable();
            $table->enum('volunteer',['Yes', 'No'])->default('No');
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zipcode', 50)->nullable();
            $table->integer('country')->nullable();
            $table->text('note')->nullable();
            $table->string('password');
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
