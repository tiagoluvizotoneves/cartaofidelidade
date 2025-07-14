<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Card;
use App\Models\Stamp;
use App\Models\Reward;
use App\Models\UserMetaSaas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RealDataSeeder extends Seeder
{
    public function run(): void
    {
        // Dono do sistema (SaaS)
        $admin = User::create([
            'name' => 'Lucas Ferreira Andrade',
            'email' => 'lucas.andrade@saas.com.br',
            'password' => Hash::make('  '),
        ]);

        UserMetaSaas::create([
            'user_id' => $admin->id,
            'plan' => 'admin',
            'is_active' => true,
            'subscribed_at' => now(),
            'expires_at' => now()->addYear(),
        ]);

        // Cliente da plataforma: Empório do Sabor
        $owner = User::create([
            'name' => 'Juliana Rocha Martins',
            'email' => 'juliana@emporiodosabor.com.br',
            'password' => Hash::make('SenhaEmporio@2025'),
        ]);

        UserMetaSaas::create([
            'user_id' => $owner->id,
            'plan' => 'pro',
            'is_active' => true,
            'subscribed_at' => now(),
            'expires_at' => now()->addMonth(),
        ]);

        $company = Company::create([
            'name' => 'Empório do Sabor',
            'slug' => Str::slug('Empório do Sabor'),
            'document' => '12.345.678/0001-90',
            'email' => $owner->email,
            'phone' => '11991234567',
            'logo_path' => null,
            'is_active' => true,
        ]);

        $card = Card::create([
            'company_id' => $company->id,
            'title' => 'Cartão Fidelidade - Empório do Sabor',
            'description' => 'Ganhe um café grátis a cada 10 visitas!',
            'total_stamps' => 10,
            'reward_description' => '1 Café expresso grátis',
            'is_active' => true,
        ]);

        // Cliente da empresa usando o cartão
        $client = User::create([
            'name' => 'Renato Oliveira Santos',
            'email' => 'renato.santos@gmail.com',
            'password' => Hash::make('Cliente2025@Renato'),
        ]);

        UserMetaSaas::create([
            'user_id' => $client->id,
            'plan' => 'cliente',
            'is_active' => true,
            'subscribed_at' => now(),
            'expires_at' => now()->addMonths(6),
        ]);

        // Carimbos para esse cliente
        for ($i = 1; $i <= 4; $i++) {
            Stamp::create([
                'card_id' => $card->id,
                'user_id' => $client->id,
                'stamped_at' => now()->subDays(10 - $i),
                'used' => false,
            ]);
        }
    }
}
