<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $path = 'https://raw.githubusercontent.com/fahimreza-dev/bangladesh-geojson/master/bd-districts.json';
        $json = json_decode(file_get_contents($path), true); 
        $districts = $json['districts'];
        foreach($districts as $district){
            District::query()->create(array(
                'division_id'  => $district['division_id'],
                'name'  => $district['name'],
                'bn_name' => $district['bn_name'],
                'lat'     => $district['lat'],
                'long'     => $district['long'],
            ));
        }
    }
}
