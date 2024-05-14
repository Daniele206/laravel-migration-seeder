<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Train;
use Illuminate\Support\Str;

use Faker\Generator as Faker;
class TrainsTableSeeder extends Seeder
{
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 100; $i++){
            $new_train = new Train();
            $new_train->agency = $faker->words(3, true);
            $new_train->slug = $this->createSlug($new_train->agency);
            $new_train->departure_station = $faker->city();
            $new_train->arrival_station = $faker->city();
            $new_train->departure_time = $faker->time();
            $new_train->arrival_time = $faker->time();
            $new_train->train_code = $faker->randomFloat(0, 0, 32767);
            $new_train->tav = $faker->randomFloat(0, 0, 1);
            $new_train->number_of_carriages = $faker->randomFloat(0, 0, 255);

            $new_train->save();
        }
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
