<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AlumniController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new middleware('permission:view alumni', only: ['index']),
            new middleware('permission:create alumni', only: ['create', 'store']),
            new middleware('permission:update alumni', only: ['update', 'edit']),
            new middleware('permission:delete alumni', only: ['destroy']),
        ];
    }

    public function index()
    {
        $alumni = Alumni::get();
        return view('role-permission.alumni.index', ['alumni' => $alumni]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.alumni.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:alumni,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $alumni = Alumni::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $alumni->syncRoles($request->roles);

        return redirect('/alumni')->with('status', 'Alumni created successfully with roles');
    }

    public function edit(Alumni $alumni)
    {
        $roles = Role::pluck('name', 'name')->all();
        $alumniRoles = $alumni->roles->pluck('name', 'name')->all();
        return view('role-permission.alumni.edit', [
            'alumni' => $alumni,
            'roles' => $roles,
            'alumniRoles' => $alumniRoles
        ]);
    }

    public function update(Request $request, Alumni $alumni)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $alumni->update($data);
        $alumni->syncRoles($request->roles);

        return redirect('/alumni')->with('status', 'Alumni Updated Successfully with roles');
    }

    public function destroy($alumniId)
    {
        $alumni = Alumni::findOrFail($alumniId);
        $alumni->delete();

        return redirect('/alumni')->with('status', 'Alumni Deleted Successfully');
    }
}
