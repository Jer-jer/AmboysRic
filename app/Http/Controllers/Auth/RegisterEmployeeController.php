<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterEmployeeController extends Controller
{
    use RegistersUsers;

    public function employeeRegistration(Request $array)
    {
        $array->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'contact_no' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $data = $array;
        $this->create($data);

        return redirect()->route('employees');
    }

    public function create(Request $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'contact_no' => $data['contact_no'],
            'address' => $data['address'],
            'status' => 'EMPLOYED',
            'position' => 'EMPLOYEE'
        ]);
        
    }
}
