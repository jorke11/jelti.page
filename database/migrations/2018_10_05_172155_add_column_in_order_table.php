<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInOrderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("referencecode")->nullable();
            $table->dateTime('last_executed')->nullable();
            $table->integer('amounted_consulted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("referencecode")->nullable();
            $table->dateTime('last_executed')->nullable();
            $table->integer('amounted_consulted');
        });
    }

}
