<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the locations table to start fresh
        DB::table('locations')->truncate();

        // Load the JSON file
        $jsonFile = public_path('locations/countries+states+cities.json');
        $data = json_decode(file_get_contents($jsonFile), true);

        // Seed the locations table
        $this->seedLocations($data);

        // Enable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function seedLocations($data)
    {
        foreach ($data as $country) {
            $countryName = $country['name'];

            if (isset($country['states'])) {
                foreach ($country['states'] as $state) {
                    $stateName = $state['name'];

                    if (isset($state['cities'])) {
                        foreach ($state['cities'] as $city) {
                            $cityName = $city['name'];

                            Location::create([
                                'country' => $countryName,
                                'state' => $stateName,
                                'city' => $cityName,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
