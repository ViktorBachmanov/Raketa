<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\Role as RoleEnum;
use App\Models\Role;


class EmployeeController extends Controller
{
    use PasswordValidationRules;

    /**
     * Store a newly created employee
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $employeeRole = Role::firstWhere('name', RoleEnum::Employee);

        return User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $employeeRole->id,
            'manager_id' => $request->user()->id,
        ]);
    }
}
