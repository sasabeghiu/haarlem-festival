<?php
require __DIR__ . '/../services/shoppingcartservice.php';

class ShoppingcartController
{
    private $shoppingcartService;

    function __construct()
    {
        $this->shoppingcartService = new ShoppingCartService();
    }

    public function index()
    {
        // change 1 to $this->userid
        $cartItems = $this->shoppingcartService->getShoppingCartByUserId(1);
        $count = $this->shoppingcartService->countProducts(1);

        //update product qty in cart
        if (isset($_GET["qty"])) {
            if ($_GET['action'] == 'update') {
                $this->shoppingcartService->updateProductQty($_GET["id"], 1, $_GET["qty"]);
                echo "<script>alert('Product qty has been updated in your shopping cart. ')</script>";
                echo "<script>window.location = '/shoppingcart'</script>";
            }
        }

        //remove product from cart
        if (isset($_POST['remove'])) {
            if ($_GET['action'] == 'remove') {
                foreach ($cartItems as $cartItem) {
                    $this->shoppingcartService->removeProductFromCart($_GET["id"], 1);
                    echo "<script>alert('Product has been removed from your shopping cart. ')</script>";
                    echo "<script>window.location = '/shoppingcart'</script>";
                }
            }
        }

        require __DIR__ . '/../views/orders/shopping-cart.php';
    }

    public function checkout()
    {
        $cartItems = $this->shoppingcartService->getShoppingCartByUserId(1);
        $count = $this->shoppingcartService->countProducts(1);

        require __DIR__ . '/../views/orders/checkout.php';
    }
}
