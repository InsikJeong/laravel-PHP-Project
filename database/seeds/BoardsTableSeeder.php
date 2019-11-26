<?php

use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        $users->each(function($user){
            $user->boards()->save(
                factory(App\Board::class)->make()
            );
        });
    }
}
