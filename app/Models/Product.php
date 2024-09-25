<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Attributs mass assignables
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
    ];

    // Accessor pour formater le prix
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' CDF';
    }

    // Relation Many-to-Many avec Order
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();
    }

    // Relation avec la catégorie (si vous avez un modèle Category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
