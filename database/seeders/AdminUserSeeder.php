<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make the first user an admin
        $user = User::first();
        if ($user) {
            $user->update(['is_admin' => true]);
            $this->command->info('✅ First user is now an admin.');
            $this->command->info('📧 Email: ' . $user->email);
        } else {
            // Create a new admin user if no users exist
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@quideals.co.ke',
                'password' => bcrypt('Password@123'),
                'is_admin' => true,
            ]);
            
            $this->command->info('');
            $this->command->info('═══════════════════════════════════════════════════');
            $this->command->info('  ✅ Admin User Created Successfully!');
            $this->command->info('═══════════════════════════════════════════════════');
            $this->command->info('  📧 Email:    admin@quideals.co.ke');
            $this->command->info('  🔑 Password: Password@123');
            $this->command->info('  🌐 Login URL: /login');
            $this->command->info('═══════════════════════════════════════════════════');
            $this->command->info('');
            $this->command->warn('⚠️  Please change the default password after first login!');
            $this->command->info('');
        }
    }
}
