<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        //去除第一个
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        //第一个用户关注其他所有用户
        $user->follow($follower_ids);

        //其他用户都关注1号用户
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }


    }
}
