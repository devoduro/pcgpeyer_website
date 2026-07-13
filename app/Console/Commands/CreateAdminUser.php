<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create 
                            {--name= : The name of the admin user}
                            {--email= : The email of the admin user}
                            {--password= : The password for the admin user}
                            {--role=admin : The role (admin, editor, viewer)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user for the dashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating new admin user...');
        $this->newLine();

        // Get user input
        $name = $this->option('name') ?: $this->ask('Enter the user\'s name');
        $email = $this->option('email') ?: $this->ask('Enter the user\'s email');
        $password = $this->option('password') ?: $this->secret('Enter the password');
        $role = $this->option('role');

        // Validate input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,editor,viewer'],
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('  - ' . $error);
            }
            return 1;
        }

        // Create user
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'is_active' => true,
            ]);

            $this->newLine();
            $this->info('✓ User created successfully!');
            $this->newLine();
            $this->table(
                ['Field', 'Value'],
                [
                    ['ID', $user->id],
                    ['Name', $user->name],
                    ['Email', $user->email],
                    ['Role', ucfirst($user->role)],
                    ['Status', $user->is_active ? 'Active' : 'Inactive'],
                ]
            );
            $this->newLine();
            $this->info('The user can now login at: ' . url('/dashboard/login'));

            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to create user: ' . $e->getMessage());
            return 1;
        }
    }
}
