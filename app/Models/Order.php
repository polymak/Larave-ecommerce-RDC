<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Attributs mass assignables
    protected $fillable = [
        'user_id', // Lier un utilisateur à la commande
        'total_price', // Prix total de la commande
        'status', // Statut de la commande
    ];

    // Relation avec le modèle Product (Many-to-Many)
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity') // Inclut la quantité dans la relation pivot
                    ->withTimestamps(); // Gère les timestamps de la relation
    }

    // Relation avec le modèle User (si vous liez la commande à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor pour formater le prix total
    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 2) . ' CDF'; // Formater le prix en CDF avec 2 décimales
    }

    // Optionnel : Scope pour filtrer par statut de commande
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
