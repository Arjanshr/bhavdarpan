<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {--name=} {--email=}';

    protected $description = 'Create an administrator account for the Bhavdarpan admin panel';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Administrator name');
        $email = $this->option('email') ?: $this->ask('Administrator email');

        $validator = Validator::make(
            ['name' => $name, 'email' => $email],
            ['name' => ['required', 'string', 'max:255'], 'email' => ['required', 'email', 'max:255']],
        );

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return self::FAILURE;
        }

        $user = User::query()->where('email', $email)->first();

        if ($user !== null && ! $this->confirm("Grant administrator access to {$user->email}?", false)) {
            $this->info('No changes were made.');

            return self::SUCCESS;
        }

        $password = $this->secret('Administrator password (at least 12 characters)');
        $confirmation = $this->secret('Confirm administrator password');

        $passwordValidator = Validator::make(
            ['password' => $password, 'confirmation' => $confirmation],
            ['password' => ['required', 'string', 'min:12'], 'confirmation' => ['required', 'same:password']],
        );

        if ($passwordValidator->fails()) {
            $this->error($passwordValidator->errors()->first());

            return self::FAILURE;
        }

        $user ??= new User;
        $user->forceFill([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ])->save();

        $this->info("Administrator account ready for {$user->email}.");

        return self::SUCCESS;
    }
}
