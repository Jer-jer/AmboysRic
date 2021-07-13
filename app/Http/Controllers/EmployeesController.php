<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = User::all();
        return view('employees', ['employees' => $data]);
    }
    public function dataShow(Request $request) 
    {
        $request_data = $request->all();
        $user_id = $request_data['id'];
        $user_data = User::where('email', $user_id)->first();

        return response()->json($user_data);
    }
    public function deleteEmployee($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect('employees');
    }
    public function adminCheck(Request $request)
    {
        $user = DB::table('users')->where('position', 'MANAGER')->first();
        if(Hash::check($request->password, $user->password)){
            return redirect('employees');
        }
        return redirect()->back()->with('error_code', 5);
    }
}
