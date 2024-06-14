<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserControllers extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('perPage');
        $users = User::paginate($perPage); // Mengambil data pengguna dengan paginasi berdasarkan jumlah per halaman
        return response()->json($users);
    }

    public function show($id)
    {
        $getUserById = User::find($id);
        return response()->json($getUserById);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password') && $request->has('password') != '') {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
