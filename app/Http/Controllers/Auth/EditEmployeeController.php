<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\updateUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EditEmployeeController extends Controller
{
    // use RegistersUsers;

    public function updateEmployee(Request $request)
    {
        $data = User::find($request->id);
        
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->contact_no = $request->contact_no;
        $data->address = $request->address;
        $data->status = $request->status;
        $data->position = $request->position;
        $data->save();

        return redirect()->route('employees');
    }
}