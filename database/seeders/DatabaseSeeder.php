<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (User::where('email', 'admin@senahighentebbe.sc.ug')->doesntExist() && User::where('email', 'test@example.com')->doesntExist()) {
            User::factory()->create([
                'name' => 'School Administrator',
                'email' => 'admin@senahighentebbe.sc.ug',
                'password' => bcrypt('password'),
            ]);
        }

        $this->call(CmsContentSeeder::class);
    }
}
