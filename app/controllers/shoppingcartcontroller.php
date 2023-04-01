<?php
require __DIR__ . '/../services/shoppingcartservice.php';

class ShoppingcartController
{
    private $shoppingcartService;

    function __construct()
    {
        $this->shoppingcartService = new ShoppingCartService();
        session_start();
    }

    public function index()
    {
        if (isset($_SESSION['userId'])) {

            // change 1 to $this->userid
            $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);
            $count = $this->shoppingcartService->countProducts($_SESSION['userId']);

            //update product qty in cart
            if (isset($_GET["qty"])) {
                if ($_GET['action'] == 'update') {
                    $this->shoppingcartService->updateProductQty($_GET["id"], $_SESSION['userId'], $_GET["qty"]);
                    echo "<script>alert('Product qty has been updated in your shopping cart. ')</script>";
                    echo "<script>window.location = '/shoppingcart'</script>";
                }
            }

            //remove product from cart
            if (isset($_POST['remove'])) {
                if ($_GET['action'] == 'remove') {
                    foreach ($cartItems as $cartItem) {
                        $this->shoppingcartService->removeProductFromCart($_GET["id"], $_SESSION['userId']);
                        echo "<script>alert('Product has been removed from your shopping cart. ')</script>";
                        echo "<script>window.location = '/shoppingcart'</script>";
                        $_SESSION['cartcount'] = $count - 1;
                    }
                }
            }
        } else {
            echo "<script>
                alert('You have to be logged in to see your cart.');
                window.location.href = '/login/index'
                </script>";
        }

        require __DIR__ . '/../views/orders/shopping-cart.php';
    }

}
