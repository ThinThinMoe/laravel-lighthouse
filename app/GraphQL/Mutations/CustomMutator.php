<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Employee;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

final readonly class CustomMutator
{
    public function login(null $_, array $args) {
        $credentials = Arr::only($args, ['email', 'password']);

        if (! Auth::once($credentials)) {
            return null;
        }
        $token = Str::random(60);
        return $token;
    }

    public function createEmployees(null $_, array $args) {
        Employee::truncate();
        Employee::factory($args['count'])->create();
        return true;
    }
}
