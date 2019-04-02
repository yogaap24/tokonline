<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
            'api_token' => str_random(18),
            'is_admin'  => true,
        ];

        DB::table('users')->insert($users);
        
        factory(App\Models\User::class,50)->create();
    }
}
