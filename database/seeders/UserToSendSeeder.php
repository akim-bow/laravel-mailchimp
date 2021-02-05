<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsersToSend;
use Illuminate\Support\Str;

class UserToSendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            UsersToSend::create([
                'name' => 'Akim' . $i,
                'surname' => 'surname' . $i,
                'email' => 'akim' . (190 + $i) . '@gmail.com',
                'subscribed' => 0,
            ]);
        }

    }
}
