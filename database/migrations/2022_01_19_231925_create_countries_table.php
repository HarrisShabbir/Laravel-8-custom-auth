<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso3');
            $table->string('iso2');
            $table->double('numeric_code');
            $table->string('phone_code');
            $table->string('capital');
            $table->string('currency');
            $table->string('currency_name');
            $table->string('currency_symbol');
            $table->string('tld');
            $table->string('region');
            $table->string('subregion');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('emoji');
            $table->string('emojiU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
