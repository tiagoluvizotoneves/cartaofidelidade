<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Card;
use App\Models\Stamp;
use App\Models\Reward;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'companiesCount' => Company::count(),
            'cardsCount' => Card::count(),
            'stampsCount' => Stamp::count(),
            'rewardsCount' => Reward::count(),
            'usersCount' => User::count(),
        ]);
    }
}
