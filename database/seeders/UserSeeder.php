<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user if it doesn't exist
        if (!User::where('email', 'admin@pcgmonninger.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@pcgmonninger.com',
                'password' => 'password123', // Will be hashed by User model mutator
                'role' => 'admin',
                'is_active' => true,
            ]);

            $this->command->info('✓ Admin user created: admin@pcgmonninger.com / password123');
        } else {
            $this->command->info('✓ Admin user already exists');
        }

        // Create default editor user if it doesn't exist
        if (!User::where('email', 'editor@pcgmonninger.com')->exists()) {
            User::create([
                'name' => 'Editor',
                'email' => 'editor@pcgmonninger.com',
                'password' => 'password123', // Will be hashed by User model mutator
                'role' => 'editor',
                'is_active' => true,
            ]);

            $this->command->info('✓ Editor user created: editor@pcgmonninger.com / password123');
        } else {
            $this->command->info('✓ Editor user already exists');
        }
    }
}
