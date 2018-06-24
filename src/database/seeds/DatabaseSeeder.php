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

        factory(App\User::class, 1000)->create();
        $idUser = App\User::all()->last()->id;
        $faker = Faker\Factory::create();
        for($i=1;$i<=$idUser;$i++){
            Bid::create([
                'theme' => $faker->realText(200,2),
                'message' => $faker->realText(2000,2),
                'file'=>'user-files/' . $faker->image(storage_path('app/user-files'),640,480,null,false),
                'user_id'=>$i
            ]);
        }
    }
}
