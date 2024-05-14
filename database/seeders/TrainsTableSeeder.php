<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Train;
use Illuminate\Support\Str;

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_train = new Train();
            $new_train->slug = $this->createSlug('trenitalia');
            $new_train->agency = 'trenitalia';
            $new_train->departure_station = 'milano';
            $new_train->arrival_station = 'benevento';
            $new_train->departure_time = '15:00:00';
            $new_train->arrival_time = '19:00:00';
            $new_train->train_code = 32000;
            $new_train->tav = 1;
            $new_train->number_of_carriages = 124;

            $new_train->save();
    }

    private function createSlug($string){
        $slug = Str::slug($string, '-');

        $original_slug = $slug;

        $exixt = Train::where('slug', $slug)->first();

        $c = 1;

        while($exixt){
            $slug = $original_slug . '-' . $c;
            $exixt = Train::where('slug', $slug)->first();
            $c++;
        }

        return $slug;
    }
}
