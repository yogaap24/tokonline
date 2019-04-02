<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_code', 12); //TR0001
            $table->string('resi_code',50)->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('kurir')->nullable();
            $table->text('destination')->nullable();
            $table->decimal('ongkir',15,2)->nullable();
            $table->enum('status_payment',['pending','confirm','paid','success'])->default('pending');
            $table->dateTime('date_transactions')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('prof_of_payment')->nullable();
            $table->decimal('grandtotal',50);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
