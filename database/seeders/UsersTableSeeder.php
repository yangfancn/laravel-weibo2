<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create();

        $user = User::first();
        $user->name = 'Yang Fan';
        $user->email = '244190857@qq.com';
        $user->password = bcrypt('19950930');
        $user->save();
    }
}
