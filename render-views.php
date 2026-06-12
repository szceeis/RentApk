<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$p1 = new \App\Models\Product();
$p1->id = 1;
$p1->title = 'GDevelop Game Pro';
$p1->type = 'game';
$p1->description = 'A great game template.';
$p1->price = 50000;

$p2 = new \App\Models\Product();
$p2->id = 2;
$p2->title = 'Android App POS';
$p2->type = 'android';
$p2->description = 'A point of sale application.';
$p2->price = 75000;

$products = [$p1, $p2];

$errors = new \Illuminate\Support\ViewErrorBag;
view()->share('errors', $errors);

function renderAndSave($viewName, $data, $filename) {
    try {
        $html = view($viewName, $data)->render();
        file_put_contents($filename, $html);
        echo "Rendered $filename\n";
    } catch (\Exception $e) {
        echo "Error $filename: " . $e->getMessage() . "\n";
    }
}

renderAndSave('welcome', ['products' => $products], 'index.html');
renderAndSave('auth.login', [], 'login.html');
renderAndSave('auth.register', [], 'register.html');
renderAndSave('dashboard', [], 'dashboard.html');
renderAndSave('admin.dashboard', ['revenue' => 150000, 'totalProducts' => 2, 'totalTransactions' => 5], 'admin-dashboard.html');
renderAndSave('cart.index', ['carts' => collect(), 'total' => 0], 'cart.html');
renderAndSave('checkout.index', ['carts' => collect(), 'total' => 0], 'checkout.html');
renderAndSave('rentals.index', ['transactions' => collect()], 'rentals.html');

renderAndSave('admin.products.index', ['products' => collect($products)], 'admin-products.html');
renderAndSave('admin.products.create', [], 'admin-products-create.html');
renderAndSave('admin.products.edit', ['product' => $p1], 'admin-products-edit.html');
renderAndSave('admin.transactions.index', ['transactions' => collect()], 'admin-transactions.html');
