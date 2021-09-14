<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(500)->create();
        $user = User::find(1);
        $user->name = '黄依依';
        $user->email = 'huangyiyi.sailvan.com';
        $user->save();
    }
}
