<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\City;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/datajson/cities.json");
        $cities = json_decode($json);

        foreach ($cities as $city) {

            City::create([
                "id" => $city->id,
                "name" => $city->name,
                "state_id" => $city->state_id,
                "state_code" => $city->state_code,
                "state_name" => $city->state_name,
                "country_id" => $city->country_id,
                "country_code" => $city->country_code,
                "country_name" => $city->country_name,
                "latitude" => $city->latitude,
                "longitude" => $city->longitude,
                "wikiDataId" => $city->wikiDataId,
            ]);
        }
    }
}

