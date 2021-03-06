<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeripheralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peripherals', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag')->unique();
            $table->string('peripheral_name');
            $table->foreignId('assignment_id')->nullable()->references('id')->on('assignments')->onDelete('set null');
            $table->foreignId('peripheral_type')->references('id')->on('peripheral_types');
            $table->foreignId('warranty_id')->nullable()->references('id')->on('warranties')->onDelete('set null');
            $table->string('issues')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('Available');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peripherals');
    }
}
