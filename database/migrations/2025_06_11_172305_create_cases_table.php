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
            $table->text('case_id');
            $table->text('customer_name');
            $table->text('passport_no');
            $table->text('country');
            $table->text('application_type');
            $table->text('application_status');
            $table->text('title');
            $table->text('message');
            $table->date('deadline')->nullable();
            $table->text('assigned_to')->nullable();
            $table->text('status'); // open, closed, pending
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
