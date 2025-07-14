<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::with(['card', 'user'])->latest()->get();
        return view('admin.rewards.index', compact('rewards'));
    }

    public function create()
    {
        $cards = Card::all();
        $users = User::all();
        return view('admin.rewards.create', compact('cards', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'card_id' => 'required|exists:cards,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,redeemed,expired',
            'redeemed_at' => 'nullable|date',
        ]);

        Reward::create($data);

        return redirect()->route('admin.rewards.index')->with('success', 'Recompensa criada com sucesso.');
    }

    public function edit(Reward $reward)
    {
        $cards = Card::all();
        $users = User::all();
        return view('admin.rewards.edit', compact('reward', 'cards', 'users'));
    }

    public function update(Request $request, Reward $reward)
    {
        $data = $request->validate([
            'card_id' => 'required|exists:cards,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,redeemed,expired',
            'redeemed_at' => 'nullable|date',
        ]);

        $reward->update($data);

        return redirect()->route('admin.rewards.index')->with('success', 'Recompensa atualizada.');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();
        return redirect()->route('admin.rewards.index')->with('success', 'Recompensa excluída.');
    }
}
