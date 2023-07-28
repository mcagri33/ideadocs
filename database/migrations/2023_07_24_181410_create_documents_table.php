<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('documents', function (Blueprint $table) {
      $table->id();
      $table->uuid();
      $table->unsignedBigInteger('user_id');
      $table->string('document_name')->nullable();
      $table->string('document_type')->nullable();
      $table->string('path')->nullable();
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
      $table->softDeletes();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('documents');
  }
};
