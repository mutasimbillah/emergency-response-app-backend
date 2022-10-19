<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //
        //$path = storage_path('json/divisions.json');
        $path = 'https://raw.githubusercontent.com/fahimreza-dev/bangladesh-geojson/master/bd-divisions.json';
        $json = json_decode(file_get_contents($path), true); 
        $divisions = $json['divisions'];
        foreach($divisions as $division){
            Division::query()->create(array(
                'name'  => $division['name'],
                'bn_name' => $division['bn_name'],
                'lat'     => $division['lat'],
                'long'     => $division['long'],
            ));
        }
    }
}
