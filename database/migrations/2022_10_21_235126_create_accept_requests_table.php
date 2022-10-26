<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('accept_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blood_request_id');
            $table->unsignedBigInteger('donner_id');
            $table->unsignedBigInteger('recipient_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('blood_request_id')->references('id')->on('blood_requests');
            $table->foreign('donner_id')->references('id')->on('users');
            $table->foreign('recipient_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('accept_requests');
    }
};
