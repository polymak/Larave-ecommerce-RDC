<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentNotificationController; // Ensure this is included
use App\Http\Controllers\PaymentController; // Ensure this is included
use App\Http\Controllers\ProductSiteController;


// Route vers la page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes pour l'authentification
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Routes pour l'inscription
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Routes pour l'authentification admin
Route::get('admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login.form');
Route::post('admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');

// Routes administratives protégées par le middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/administration', [DashboardController::class, 'administration'])->name('admin.administration');
    Route::resource('admin/products', ProductController::class);
    Route::resource('admin/categories', CategoryController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/orders', OrderController::class);

    // Profil (authentification nécessaire)
    Route::get('/profile', [ProfileController::class, 'index_profile_frontend'])->name('profile');
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/orders', [ProfileController::class, 'showOrders'])->name('profile.orders');
});

// Routes frontend pour les catégories, commandes, et panier
Route::get('/site/categories', [CategoryController::class, 'index_category_frontend'])->name('categories.site1');
Route::get('/site/orders', [OrderController::class, 'index_order_frontend'])->name('orders.site2');
Route::get('/site/cart', [CartController::class, 'index_cart_frontend'])->name('cart.site3');

// Routes pour les ressources (produits, catégories, utilisateurs, commandes)
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);
Route::resource('orders', OrderController::class);

// Route pour annuler une commande
Route::delete('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Routes pour les produits individuels
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/upload-image', [ProductController::class, 'uploadImage'])->name('upload.image');

// Routes pour ajouter un produit à une commande
Route::post('/orders/{order}/add-product', [OrderController::class, 'addProductToOrder'])->name('orders.addProduct');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// Routes pour le panier
Route::get('/panier', [CartController::class, 'index_cart_frontend'])->name('cart.index');
Route::post('/panier/ajouter', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/panier/mettre-a-jour', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/panier/supprimer/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/panier/vider', [CartController::class, 'clearCart'])->name('cart.clear');

// Routes pour aller à la page de commande (checkout)
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Routes pour la recherche
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Route pour acheter les produits dans le panier
Route::post('/acheter', [CartController::class, 'buy'])->name('cart.buy');

// Routes pour le processus de paiement
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');

// Routes pour le traitement de la notification et la redirection après le paiement
Route::post('/payment/notify', [PaymentNotificationController::class, 'handleNotification'])->name('payment.notify');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');


// Routes pour le panier
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Route pour le paiement
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');

// Route pour le processus de paiement
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');

// Route pour la page de confirmation
Route::get('/confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'processPayment'])->name('checkout.process');
Route::get('/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success'); // À créer si nécessaire
Route::post('/payment/notify', [CheckoutController::class, 'paymentNotify'])->name('payment.notify'); // À créer si nécessaire
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/productsite/{id}', [ProductSiteController::class, 'show'])->name('productsite.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.indexcat');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');



// Afficher le panier
Route::get('/cart', [CartController::class, 'index_cart_frontend'])->name('cart.index');

// Ajouter un produit au panier
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

// Mettre à jour un produit dans le panier
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// Supprimer un produit du panier
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Vider le panier
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Page de commande
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/error', [PaymentController::class, 'error'])->name('payment.error');

Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/notify', [PaymentNotificationController::class, 'handleNotification'])->name('payment.notify');



Route::get('/payment', [PaymentController::class, 'showForm']);
Route::post('/payment', [PaymentController::class, 'processPayment']);
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::post('/payment', [PaymentController::class, 'store']);
Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

Route::post('/payment/store', [PaymentController::class, 'store']);

Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');


Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');

Route::get('/success', [PaymentController::class, 'success'])->name('success.page');