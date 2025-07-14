<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\WpUser;
use Illuminate\Support\Str;

class WpUserProvider implements UserProvider
{
    protected $model;
    protected $hasher;

    public function __construct($hasher, $model)
    {
        $this->model = $model;
        $this->hasher = $hasher;
    }

    public function retrieveById($identifier)
    {
        return $this->createModel()->newQuery()->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return null; // Token-based auth (remember me) não usado aqui
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Não implementado, mas pode ser usado se necessário
    }

    public function retrieveByCredentials(array $credentials)
    {
        $login = $credentials['email'] ?? $credentials['user_login'];
        return $this->createModel()->newQuery()
            ->where('user_login', $login)
            ->orWhere('user_email', $login)
            ->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        // Verifica hash nativo do WP (bcrypt ou phpass)
        return $this->checkPassword($plain, $user->getAuthPassword());
    }

    protected function checkPassword($password, $hash)
    {
        if (Str::startsWith($hash, '$P$') || Str::startsWith($hash, '$H$')) {
            return (new \PasswordHash(8, true))->CheckPassword($password, $hash);
        }

        return $this->hasher->check($password, $hash);
    }

    protected function createModel()
    {
        return new $this->model;
    }
}
