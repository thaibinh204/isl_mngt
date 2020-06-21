<?php

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'first_name' => 'hai',
            'last_name' => 'nguyen',
            'email' => 'hai@123',
            'password' => Hash::make('123456')
        ]);
    }
}
