<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien vers l'utilisateur
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Lien vers le produit
            $table->integer('quantity'); // Quantité commandée
            $table->decimal('total_price', 10, 2); // Prix total
            $table->string('order_number')->default('default_order_number'); // Valeur par défaut
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
