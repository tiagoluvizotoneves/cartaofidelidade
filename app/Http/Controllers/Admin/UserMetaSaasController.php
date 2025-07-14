<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMetaSaas;
use Illuminate\Http\Request;

class UserMetaSaasController extends Controller
{
    public function index()
    {
        $metas = UserMetaSaas::with('user')->latest()->get();
        return view('admin.user-meta-saas.index', compact('metas'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.user-meta-saas.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|string',
            'is_active' => 'required|boolean',
            'subscribed_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
        ]);

        UserMetaSaas::create($data);

        return redirect()->route('admin.user-meta-saas.index')->with('success', 'Plano cadastrado.');
    }

    public function edit(UserMetaSaas $userMetaSaas)
    {
        $users = User::all();
        return view('admin.user-meta-saas.edit', compact('userMetaSaas', 'users'));
    }

    public function update(Request $request, UserMetaSaas $userMetaSaas)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|string',
            'is_active' => 'required|boolean',
            'subscribed_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
        ]);

        $userMetaSaas->update($data);

        return redirect()->route('admin.user-meta-saas.index')->with('success', 'Plano atualizado.');
    }

    public function destroy(UserMetaSaas $userMetaSaas)
    {
        $userMetaSaas->delete();

        return redirect()->route('admin.user-meta-saas.index')->with('success', 'Plano excluído.');
    }
}
