<?php

namespace Database\Seeders;

use App\Models\Chain;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /** @var Chain $chain */
        $chain = Chain::query()->create([
            'name' => 'Ethereum Mainnet',
        ]);

        /** @var User $user */
        $user = User::query()->create([
            'name' => 'user',
            'email' => 'user@email.com',
            'password' => 'password',
        ]);

        Wallet::factory()->count(1)->create([
            'name' => 'My ETH Wallet',
            'chain_id' => $chain->id,
            'user_id' => $user->id,
        ]);

        /** @var User $guest */
        $guest = User::query()->create([
            'name' => 'guest',
            'email' => 'guest@email.com',
            'password' => 'password',
        ]);

        Wallet::factory()->count(1)->create([
            'name' => 'My ETH Wallet',
            'chain_id' => $chain->id,
            'user_id' => $guest->id,
        ]);
    }
}
