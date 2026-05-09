<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\ModelUser;

class ControllerUser extends Controller
{
    public function index(Request $request)
    {
        $query = ModelUser::query();

        if ($request->q) {
            $query->where('name', 'like', '%' . $request->q . '%')
                ->orWhere('username', 'like', '%' . $request->q . '%')
                ->orWhere('email', 'like', '%' . $request->q . '%');
        }

        $data = $query->orderBy('id', 'desc')->get();

        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username',
            'email' => 'nullable|email|max:100|unique:user,email',
            'password' => 'required|min:6',
            'role' => 'required|in:owner,manager,kasir',
            'isactive' => 'required|in:0,1',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('user', 'public');
        }

        ModelUser::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'foto' => $fotoPath,
            'isactive' => $request->isactive,
        ]);

        return redirect()->route('master.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function show($id)
    {
        $data = ModelUser::findOrFail($id);
        return view('admin.user.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelUser::findOrFail($id);
        return view('admin.user.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelUser::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username,' . $data->id,
            'email' => 'nullable|email|max:100|unique:user,email,' . $data->id,
            'role' => 'required|in:owner,manager,kasir',
            'isactive' => 'required|in:0,1',
            'password' => 'nullable|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'isactive' => $request->isactive,
        ];

        // jika password diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // jika upload foto baru
        if ($request->hasFile('foto')) {

            // hapus foto lama jika ada
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }

            $updateData['foto'] = $request->file('foto')->store('user', 'public');
        }

        $data->update($updateData);

        return redirect()->route('master.user.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = ModelUser::findOrFail($id);

        // hapus foto jika ada
        if ($data->foto && Storage::disk('public')->exists($data->foto)) {
            Storage::disk('public')->delete($data->foto);
        }

        $data->delete();

        return redirect()->route('master.user.index')->with('success', 'User berhasil dihapus!');
    }
}