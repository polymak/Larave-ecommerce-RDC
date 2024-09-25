<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // Ajoutez ceci

class User extends Authenticatable
{
    use HasFactory; // N'oubliez pas d'utiliser le trait HasFactory

    protected $fillable = [
        'name', 'email', 'password', 'role', // Ajoutez 'role' ici si nécessaire
    ];

    // Définir la relation avec les commandes
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class); // Assurez-vous que la classe Order est correctement importée
    }
}
