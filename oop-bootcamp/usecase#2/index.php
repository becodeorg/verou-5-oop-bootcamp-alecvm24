<?php
class product {
    public $name;
    public $quantity;
    public $price;

    public function __construct($name, $quantity, $price) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function calculateSubtotal() {
        $subtotal = $this->quantity * $this->price;

        if ($this->isFruit()) {
            $subtotal *= 0.5;
        }

        return $subtotal;
    }

    public function isFruit() {
        $fruits = ['Banana', 'Apple'];
        return in_array($this->name, $fruits);    
    }

}

class Basket {
    public $products;

    public function __construct($products) {
        $this->products = $products;
    }

    public function calculateTotalPrice() {
        $totalPrice = 0;

        foreach($this->products as $product){
            $totalPrice += $product->calculateSubtotal();
        }

        return $totalPrice;
    }


public function calculateTaxAmount() {
    $fruitTaxRate = 0.06;
    $wineTaxRate = 0.21;

    $fruitSubtotal = 0;
    $wineSubtotal = 0;

    foreach ($this->products as $product) {
        if($product->name === 'Wine') {
            $wineSubtotal += $product->calculateSubtotal();
        } else {
            $fruitSubtotal += $product->calculateSubtotal();
        }
    }

    return($fruitSubtotal * $fruitTaxRate) + ($wineSubtotal * $wineTaxRate);
}
}

$banana = new Product('Banana', 6, 1);
$apple = new Product('Apple', 3, 1.5);
$wine = new Product('Wine', 2, 10);

$basket = new Basket([$banana, $apple, $wine]);

$totalPrice = $basket->calculateTotalPrice();
$taxAmount = $basket->calculateTaxAmount();

echo "Total Price: €" . number_format($totalPrice, 2) . "<br>";
echo "Tax Amount: €" . number_format($taxAmount, 2) . "<br>";