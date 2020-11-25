<?php

use App\Models\User;
use App\Models\Setting;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'username' => 'david',
            'password' => bcrypt('password'),
            'employee_id' => Employee::all()->random()->id,
            'remember_token' => Str::random(10),
        ]);

        Setting::setSetting('profile_complete', 0);
    }
}
