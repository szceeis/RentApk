<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$products = [
    (object)[
        'id' => 1,
        'title' => 'GDevelop Game Pro',
        'type' => 'game',
        'image' => null,
        'description' => 'A great game template.',
        'price' => 50000
    ],
    (object)[
        'id' => 2,
        'title' => 'Android App POS',
        'type' => 'android',
        'image' => null,
        'description' => 'A point of sale application.',
        'price' => 75000
    ]
];

$errors = new \Illuminate\Support\ViewErrorBag;
view()->share('errors', $errors);

function renderAndSave($viewName, $data, $filename) {
    try {
        $html = view($viewName, $data)->render();
        file_put_contents('views/' . $filename, $html);
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
