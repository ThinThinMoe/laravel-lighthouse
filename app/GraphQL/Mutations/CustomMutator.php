<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\Employee;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeExport;

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

    public function getEmployees() {
        return Excel::download(new EmployeeExport, 'employee.xlsx');
    }
}
