<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ModelLoginHistory;

class ControllerAuthLoginHistory extends Controller
{
    public function index()
    {
        $data = ModelLoginHistory::with('user')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.loginhistory.index', compact('data'));
    }

    public function show($id)
    {
        $data = ModelLoginHistory::with('user')->findOrFail($id);

        return view('admin.loginhistory.show', compact('data'));
    }

    public function destroy($id)
    {
        $data = ModelLoginHistory::findOrFail($id);
        $data->delete();

        return redirect()->route('loginhistory.index')
            ->with('success', 'Log berhasil dihapus.');
    }
}