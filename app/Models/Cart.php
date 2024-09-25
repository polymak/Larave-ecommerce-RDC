<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Définissez les attributs que vous souhaitez mass assign
    protected $fillable = ['product_id', 'quantity', 'price'];

    // Si vous avez des relations, définissez-les ici
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
