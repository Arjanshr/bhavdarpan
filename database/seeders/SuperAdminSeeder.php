<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use InvalidArgumentException;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $name = config('admin.superadmin.name');
        $email = config('admin.superadmin.email');
        $password = config('admin.superadmin.password');

        if (! \is_string($password) || mb_strlen($password) < 12) {
            throw new InvalidArgumentException('Set SUPERADMIN_PASSWORD to a password with at least 12 characters before running this seeder.');
        }

        $user = User::query()->where('email', $email)->first();

        if ($user !== null) {
            if (! $user->is_admin) {
                $user->forceFill(['is_admin' => true])->save();
            }

            return;
        }

        $user = new User;
        $user->forceFill([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
        ])->save();
    }
}
