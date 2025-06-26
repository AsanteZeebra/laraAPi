<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable(); // Foreign key to clients table
            $table->string('fullname')->nullable(); // Full name of the passport holder
            $table->string('passport_no')->unique(); // Unique passport number
            $table->string('nationality')->nullable(); // Nationality of the passport holder
            $table->date('issue_date')->nullable(); // Date of issue
            $table->date('expiry_date')->nullable(); // Date of expiry
            $table->string('email')->unique(); // Email of the passport holder
            $table->text('message')->nullable(); // Additional notes or message
            $table->string('staff')->nullable(); // Staff member who processed the passport
            $table->string('status')->nullable(); // Status of the passport (e.g., active, expired)
            $table->string('photo_path')->nullable(); // Path to the passport photo
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passports');
    }
}
