<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Company;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::with('company')->latest()->paginate(10);
        return view('admin.cards.index', compact('cards'));
    }

    public function create()
    {
        $companies = Company::where('is_active', true)->get();
        return view('admin.cards.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'total_stamps' => 'required|integer|min:1',
            'reward_description' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        Card::create($request->all());

        return redirect()->route('admin.cards.index')->with('success', 'Cartão criado com sucesso!');
    }

    public function edit(Card $card)
    {
        $companies = Company::where('is_active', true)->get();
        return view('admin.cards.edit', compact('card', 'companies'));
    }

    public function update(Request $request, Card $card)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'total_stamps' => 'required|integer|min:1',
            'reward_description' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $card->update($request->all());

        return redirect()->route('admin.cards.index')->with('success', 'Cartão atualizado com sucesso!');
    }

    public function destroy(Card $card)
    {
        $card->delete();

        return redirect()->route('admin.cards.index')->with('success', 'Cartão excluído com sucesso!');
    }
}
