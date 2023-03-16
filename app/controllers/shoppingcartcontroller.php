<?php
require __DIR__ . '/../services/productservice.php';

class ShoppingcartController
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_POST['remove'])) {
            if ($_GET['action'] == 'remove') {
                foreach ($_SESSION['shopping-cart'] as $key => $value) {
                    if ($value["product_id"] == $_GET['id']) {
                        unset($_SESSION['shopping-cart'][$key]);
                        echo "<script>alert('Product has been removed from your shopping cart. ')</script>";
                        echo "<script>window.location = '/shoppingcart'</script>";
                    }
                }
            }
        }

        if (isset($_SESSION['shopping-cart'])) {
            $product_id = array_column($_SESSION['shopping-cart'], 'product_id');
            foreach ($product_id as $id) {
                $product = $this->productService->getOneProduct($id);
                $products[] = $product;
            }
        }

        require __DIR__ . '/../views/shopping-cart.php';
    }
}
