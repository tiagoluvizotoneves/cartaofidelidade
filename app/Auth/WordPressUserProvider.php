<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\DB;

class WordPressUserProvider implements UserProvider
{
    protected string $table = 'seu_prefixo_users'; // 👈 ALTERE AQUI para o nome real da tabela wp_users

    public function retrieveById($identifier)
    {
        $user = DB::table($this->table)->where('ID', $identifier)->first();
        return $this->getGenericUser($user);
    }

    public function retrieveByToken($identifier, $token)
    {
        return null; // não usamos remember_token
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // vazio de propósito
    }

    public function retrieveByCredentials(array $credentials)
    {
        $user = DB::table($this->table)
            ->where('user_login', $credentials['email'])
            ->orWhere('user_email', $credentials['email'])
            ->first();

        return $this->getGenericUser($user);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        require_once base_path('../wordpress/wp-includes/class-phpass.php'); // 👈 Caminho real do WP instalado

        $hasher = new \PasswordHash(8, true);
        return $hasher->CheckPassword($plain, $user->getAuthPassword());
    }

    protected function getGenericUser($user)
    {
        if (! $user) return null;

        return new class((array) $user) implements Authenticatable {
            private $attributes;

            public function __construct(array $attributes)
            {
                $this->attributes = $attributes;
            }

            public function getAuthIdentifierName()
            {
                return 'ID';
            }
            public function getAuthIdentifier()
            {
                return $this->attributes['ID'];
            }
            public function getAuthPassword()
            {
                return $this->attributes['user_pass'];
            }

            public function getRememberToken() {}
            public function setRememberToken($value) {}
            public function getRememberTokenName() {}

            public function __get($key)
            {
                return $this->attributes[$key] ?? null;
            }

            public function toArray()
            {
                return $this->attributes;
            }
        };
    }
}
