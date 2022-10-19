<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Upazila;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpazilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $path = 'https://raw.githubusercontent.com/fahimreza-dev/bangladesh-geojson/master/bd-upazilas.json';
        $json = json_decode(file_get_contents($path), true); 
        $upazilas = $json['upazilas'];
        //dd($upazilas);
        foreach($upazilas as $upazila){
            Upazila::query()->create(array(
                'district_id'  => $upazila['district_id'],
                'name'  => $upazila['name'],
                'bn_name' => $upazila['bn_name'],
            ));
        }
    }
}
