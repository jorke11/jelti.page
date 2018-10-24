<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsCommentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->text('subject');
            $table->text('comment');
            $table->integer('answer_id')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('products_comment');
    }

}
