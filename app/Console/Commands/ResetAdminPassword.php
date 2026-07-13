<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password 
                            {email : The email of the user}
                            {--password= : The new password (optional, will prompt if not provided)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset password for an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->option('password');

        // Find user
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found!");
            return 1;
        }

        // Get password if not provided
        if (!$password) {
            $password = $this->secret('Enter new password (min 8 characters)');
            $confirmPassword = $this->secret('Confirm new password');

            if ($password !== $confirmPassword) {
                $this->error('Passwords do not match!');
                return 1;
            }
        }

        // Validate password length
        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters long!');
            return 1;
        }

        // Update password
        $user->password = $password;
        $user->save();

        $this->newLine();
        $this->info('✓ Password reset successfully!');
        $this->newLine();
        $this->table(
            ['Field', 'Value'],
            [
                ['User', $user->name],
                ['Email', $user->email],
                ['Role', ucfirst($user->role)],
                ['Status', $user->is_active ? 'Active' : 'Inactive'],
            ]
        );
        $this->newLine();
        $this->info('The user can now login with the new password.');

        return 0;
    }
}
