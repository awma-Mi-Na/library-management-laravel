<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowing_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('borrowing_id')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('book_id')->constrained();
            $table->timestamps();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('returned_date')->nullable();
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowing_histories');
    }
}
