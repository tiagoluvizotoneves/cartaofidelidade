<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class WpUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'wp_users';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'user_login',
        'user_pass',
        'user_email',
        'user_nicename',
        'display_name',
    ];

    public function getAuthIdentifierName()
    {
        return 'user_login';
    }

    public function getAuthPassword()
    {
        return $this->user_pass;
    }
}
