<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $this->call([
            RoleSeeder::class,
            JenisMaterialSeeder::class,
            UserSeeder::class,
            UserDetailSeeder::class,
            DesignSeeder::class,
            ContentMediaSeeder::class,
            MaterialSeeder::class,
            ProjectSeeder::class,
            CustomizationSeeder::class,
            ProgressLogSeeder::class,
            PaymentSeeder::class,
            PaymentProgressSeeder::class,
            ChatSeeder::class,
            ForgetCodeSeeder::class,
        ]);


        // User::factory(10)->create();
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
