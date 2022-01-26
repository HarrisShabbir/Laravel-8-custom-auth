<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\File;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/datajson/countries.json");
        $countries = json_decode($json);

        foreach ($countries as $country) {

            Country::create([
                "id" => $country->id,
                "name" => $country->name,
                "iso3" => $country->iso3,
                "iso2" => $country->iso2,
                "numeric_code" => $country->numeric_code,
                "phone_code" => $country->phone_code,
                "capital" => $country->capital,
                "currency" => $country->currency,
                "currency_name" => $country->currency_name,
                "currency_symbol" => $country->currency_symbol,
                "tld" => $country->tld,
                "region" => $country->region,
                "subregion" => $country->subregion,
                "latitude" => $country->latitude,
                "longitude" => $country->longitude,
                "emoji" => $country->emoji,
                "emojiU" => $country->emojiU,                

            ]);
        }
    }
}
