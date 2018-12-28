<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Model\Bid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Manager',
                'email' => 'nikitagizatulin@gmail.com',
                'password' => Hash::make('123456'),
                'user_role' => 'manager'
            ]
        ]);
        $numberData = 100;
        // factory(App\User::class, 1000)->create();
        factory(App\User::class, $numberData)->create();
        $idUser = App\User::all()->last()->id;
        $faker = Faker\Factory::create();
        File::makeDirectory('public/storage/images', $mode = 0777, true, true);
        for($i=$idUser - $numberData;$i<=$idUser;$i++){
            Bid::create([
                'theme' => $faker->realText(200,2),
                'message' => $faker->realText(2000,2),
                'file'=> $faker->image('public/storage/images',640,480,null,false),
                'user_id'=>$i
            ]);
        }
    }
}
// premission developer:www-data
// public more premission
// Storage use