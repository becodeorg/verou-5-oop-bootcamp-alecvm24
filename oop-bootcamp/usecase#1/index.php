<?php 
// Basket without classes
    $Basket = [
        "Banana" => ["quantity" => 6, "price" => 1, "tax" => 0.06],
        "Apples" => ["quantity" => 3, "price" => 1.5, "tax" => 0.06],
        "Wine" => ["quantity" => 2, "price" => 10, "tax" => 0.21],
    ];

     $totalPrice = 0;
     $taxAmount = 0;

     foreach($Basket as $itemName => $itemDetails){
        $itemSubtotal = $itemDetails["quantity"] * $itemDetails["price"];
        $totalPrice += $itemSubtotal;

        $itemTax = $itemSubtotal *$itemDetails["tax"];
        $taxAmount += $itemTax;
    }
    
     echo "Total Price: €" . number_format($totalPrice, 2) . "<br>";
     echo "Tax Amount: €" . number_format($taxAmount, 2) . "<br>";


// Basket with classes

    class Product {
        public $name;
        public $quantity;
        public $price;

        public function __construct ($name, $quantity, $price) {
            $this->name = $name;
            $this->quantity = $quantity;
            $this->price = $price;
        }

        public function calculateSubtotal () {
            return $this->quantity * $this->price;
        }
    }

    class Basket {
        public $products;

        public function __construct ($products) {
            $this->products = $products;
        }

        public function calculateTotalPrice() {
            $totalPrice = 0;

            foreach($this->products as $products) {
                $totalPrice += $products->calculateSubtotal();
            }

            return $totalPrice;
        }

        public function calculateTaxAmount() {
            $fruitTaxRate = 0.06;
            $wineTaxRate = 0.21;

            $fruitSubtotal = 0;
            $wineSubtotal = 0;

            foreach($this->products as $products) {
                if($products->name === 'wine'){
                    $wineSubtotal += $products->calculateSubtotal();
                } else {
                    $fruitSubtotal += $products->calculateSubtotal();
                }
            }
            
            return( $fruitSubtotal * $fruitTaxRate) + ($wineSubtotal * $wineTaxRate);
        }
    }

    $banana = new Product ('Banana', 6, 1);
    $apple = new Product ('Apple', 3, 1.5);
    $wine = new Product ('Wine', 2, 10);

    $basket = new Basket([$banana, $apple, $wine]);

    $totalPrice = $basket->calculateTotalPrice();
    $taxAmount = $basket->calculateTaxAmount();
    
    echo "Total Price: €" . number_format($totalPrice, 2) . "<br>";
    echo "Tax Amount: €" . number_format($taxAmount, 2) . "<br>";
?>