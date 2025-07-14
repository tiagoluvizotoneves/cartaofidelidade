<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMetaSaas extends Model
{
    use HasFactory;

    protected $table = 'user_meta_saas';

    protected $fillable = [
        'user_id',
        'plan',
        'is_active',
        'subscribed_at',
        'expires_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
