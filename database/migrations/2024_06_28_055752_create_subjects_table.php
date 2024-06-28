<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing unsigned BIGINT (primary key)
            $table->string('subject', 255); // Creates a VARCHAR column for subject with length 255
            $table->timestamp('created_at')->useCurrent(); // Creates a TIMESTAMP column with current time as default value
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // Creates a TIMESTAMP column with current time as default value and updates with current time on update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
