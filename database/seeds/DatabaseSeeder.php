<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\User::truncate();
        //모든 데이터 삭제, auto_increment 컬럼을 0로 초기화 
        $this->call(UsersTableSeeder::class);
        App\Board::truncate();
        $this->call(BoardsTableSeeder::class);
    }
}
