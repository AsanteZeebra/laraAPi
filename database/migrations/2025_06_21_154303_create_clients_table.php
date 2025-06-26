<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('fullname')->nullable();
            $table->string('passport_no')->nullable(); // changed to snake_case
            $table->string('nationality')->nullable();
            $table->date('issue_date')->nullable(); // changed to date
            $table->date('expiry_date')->nullable(); // changed to date
            $table->string('email')->unique(); // removed nullable for unique email
            $table->string('telephone')->nullable();
            $table->string('photo_path')->nullable(); // store file path instead of binary
            $table->string('country_of_interest')->nullable();
            $table->string('application_type')->nullable();
            $table->year('year')->nullable(); // changed to year
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('clients');
    }
}
