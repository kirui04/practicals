<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Africa' => ['Kenya', 'South Africa', 'Eqypt', 'Nigeria'],
            'Europe' => ['England', 'Netherlands', 'Germany', 'Spain'],
            'America' => ['USA', 'Canada', 'Chile'],
            'Asia' => ['China', 'India', 'Iran', 'Iraq']
        ];

        foreach ($names as $region => $countries) {
            $region = \App\Region::create([
                'name' => $region,
                'class' => 'Developing County'
            ]);
            foreach ($countries as $country) {
                \App\Country::create([
                    'name' => $country,
                    'region_id' => $region->id
                ]);
            }
        }
    }
}
