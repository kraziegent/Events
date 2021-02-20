<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VenueSeeder extends Seeder
{
    public function run()
    {
        $venues = [
            ['id' => 1, 'venue' => '{"fr":"physical location","en":"physical location","nl":"physical location"}', 'service' => null, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'venue' => '{"fr":"zoom","en":"zoom","nl":"zoom"}', 'service' => null, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'venue' => '{"fr":"teams","en":"teams","nl":"teams"}', 'service' => null, 'status' => '{"fr":"1","en":"1","nl":"1"}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'venue' => '{"fr":"meets","en":"meets","nl":"meets"}', 'service' => null, 'status' => '{"fr": 1, "en": 1, "nl": 1}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('event_venues')->insert($venues);
    }
}
