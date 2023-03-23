<?php

require __DIR__ . '/../services/historyeventservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';


class HistoryEventController
{

    private $historyeventService;
    private $cartService;

    function __construct()
    {
        $this->historyeventService = new HistoryEventService();
        $this->cartService = new ShoppingCartService();
    }

    public function index()
    {
        if (isset($_POST['add-to-cart'])) {
            $user_id = 1;
            $product_id = htmlspecialchars($_POST["product_id"]);
            $qty = 1;

            $cartItem = new ShoppingCartItem();

            $cartItem->setUser_id($user_id);
            $cartItem->setProduct_id($product_id);
            $cartItem->setQty($qty);
            if ($this->cartService->checkIfProductExistsInCart($user_id, $product_id)) {
                echo "<script>alert('This product is already in your shopping cart. You can change the quantity in the shopping cart page.')</script>";
            } else {
                $this->cartService->addProductToCart($cartItem);
            }
        }

        if (isset($_POST["friday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-28%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-29%');
        } else if (isset($_POST["sunday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-30%');
        } else if (isset($_POST["monday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-31%');
        } else {
            $model = $this->historyeventService->getAll();
        }

        require __DIR__ . '/../views/historyevent/index.php';
    }
}
