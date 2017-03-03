<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operation_id')->unsigned();
            $table->integer('categorie_id')->unsigned();
            $table->integer('companie_id')->unsigned();
            $table->string('destination');
            $table->string('time');
            $table->date('date');
            $table->string('person_name')->nullable();
            $table->string('person_id')->nullable();
            $table->string('person_occupation')->nullable();
            $table->string('person_company')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('vehicle_plate')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('material_type')->nullable();
            $table->decimal('material_quantity',9,2)->nullable()->default(0);
            $table->integer('unit_id')->nullable()->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
