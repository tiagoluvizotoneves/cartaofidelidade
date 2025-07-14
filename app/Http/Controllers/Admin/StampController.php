<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stamp;
use App\Models\Card;
use App\Models\User;

class StampController extends Controller
{
    public function index()
    {
        $stamps = Stamp::with(['user', 'card'])->latest()->paginate(10);
        return view('admin.stamps.index', compact('stamps'));
    }

    public function create()
    {
        $users = User::all();
        $cards = \App\Models\Card::all();
        return view('admin.stamps.create', compact('users', 'cards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'card_id' => 'required|exists:cards,id',
            'stamped_at' => 'nullable|date',
            'used' => 'boolean',
        ]);

        Stamp::create($request->all());

        return redirect()->route('admin.stamps.index')->with('success', 'Carimbo criado com sucesso.');
    }

    public function edit(Stamp $stamp)
    {
        $users = User::all();
        $cards = \App\Models\Card::all();
        return view('admin.stamps.edit', compact('stamp', 'users', 'cards'));
    }

    public function update(Request $request, Stamp $stamp)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'card_id' => 'required|exists:cards,id',
            'stamped_at' => 'nullable|date',
            'used' => 'boolean',
        ]);

        $stamp->update($request->all());

        return redirect()->route('admin.stamps.index')->with('success', 'Carimbo atualizado com sucesso.');
    }

    public function destroy(Stamp $stamp)
    {
        $stamp->delete();
        return redirect()->route('admin.stamps.index')->with('success', 'Carimbo removido.');
    }
}
