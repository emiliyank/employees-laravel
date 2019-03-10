<?php

use Illuminate\Database\Seeder;

class SubservantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i =0; $i < 4995; $i++){
            $user = factory(App\User::class)->states('subservant')->create();
            $user->assignManagers();
        }
    }
}
