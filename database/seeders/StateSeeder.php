<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\State;
class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/datajson/states.json");
        $states = json_decode($json);

        foreach ($states as $state) {

            State::create([
                "id" => $state->id,
                "name" => $state->name,
                "country_id" => $state->country_id,
                "country_code" => $state->country_code,
                "country_name" => $state->country_name,
                "state_code" => $state->state_code,
                "type" => $state->type,
                "latitude" => $state->latitude,
                "longitude" => $state->longitude,
            ]);
        }
    }
}
