<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->text('case_id')->nullable();
            $table->text('customer_name')->nullable();
            $table->text('passport_no')->nullable();
            $table->text('country')->nullable();
            $table->text('application_type')->nullable();
            $table->text('application_status')->nullable();
            $table->text('tittle')->nullable();
            $table->text('message')->nullable();
            $table->date('deadline')->nullable();
            $table->text('assigned_to')->nullable();
            $table->text('status')->nullable(); // open, closed, pending
            // $table->text('priority')->default('normal'); // normal, high, low
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
        Schema::dropIfExists('cases');
    }
}
