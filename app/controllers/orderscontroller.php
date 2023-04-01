<?php
require __DIR__ . '/../services/shoppingcartservice.php';
require __DIR__ . '/../services/ordersservice.php';

class OrdersController
{
    private $placeorderService;
    private $shoppingcartService;

    function __construct()
    {
        $this->placeorderService = new OrdersService();
        $this->shoppingcartService = new ShoppingCartService();
        session_start();
    }

    public function cms()
    {
        //Functionality editing
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateOrder = $this->placeorderService->getOnePlacedOrder($id);
        }
        //Functionality update
        if (isset($_POST["update"])) {
            $firstName = htmlspecialchars($_POST["changedfirstName"]);
            $lastName = htmlspecialchars($_POST["changedlastName"]);
            $birthdate = htmlspecialchars($_POST["changedbirthdate"]);
            $emailAddress = htmlspecialchars($_POST["changedemailAddress"]);
            $streetAddress = htmlspecialchars($_POST["changedstreetAddress"]);
            $country = htmlspecialchars($_POST["changedcountry"]);
            $zipCode = htmlspecialchars($_POST["changedzipCode"]);
            $phoneNumber = htmlspecialchars($_POST["changedphoneNumber"]);

            $placedorder = new Orders();

            $placedorder->setFirstName($firstName);
            $placedorder->setLastName($lastName);
            $placedorder->setBirthDate($birthdate);
            $placedorder->setEmailAddress($emailAddress);
            $placedorder->setStreetAddress($streetAddress);
            $placedorder->setCountry($country);
            $placedorder->setZipCode($zipCode);
            $placedorder->setPhoneNumber($phoneNumber);

            $this->placeorderService->updatePlacedOrder($placedorder, $_GET["updateID"]);

            if ($this->placeorderService) {
                echo "<script>alert('Order updated successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to update Order! ')</script>";
            }
        }

        $model = $this->placeorderService->getAllOrders();

        require __DIR__ . '/../views/cms/order/index.php';
    }

    public function checkout()
    {
        if (isset($_SESSION['userId'])) {
            $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);
            $count = $this->shoppingcartService->countProducts($_SESSION['userId']);

            require __DIR__ . '/../views/orders/checkout.php';
        } else {
            echo "<script>
                alert('You have to be logged in to see checkout.');
                window.location.href = '/login/index'
                </script>";
        }

        if (isset($_SESSION['userEmail'])) {
            if (isset($_POST["placeorder"])) {
                $firstName = htmlspecialchars($_POST["firstName"]);
                $lastName = htmlspecialchars($_POST["lastName"]);
                $birthdate = htmlspecialchars($_POST["birthdate"]);
                $emailAddress = $_SESSION['userEmail'];
                $streetAddress = htmlspecialchars($_POST["streetAddress"]);
                $country = htmlspecialchars($_POST["country"]);
                $zipCode = htmlspecialchars($_POST["zipCode"]);
                $phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
                $totalprice = $_SESSION['totalprice'];

                $placeorder = new Orders();

                $placeorder->setFirstName($firstName);
                $placeorder->setLastName($lastName);
                $placeorder->setBirthDate($birthdate);
                $placeorder->setEmailAddress($emailAddress);
                $placeorder->setStreetAddress($streetAddress);
                $placeorder->setCountry($country);
                $placeorder->setZipCode($zipCode);
                $placeorder->setPhoneNumber($phoneNumber);
                $placeorder->setUserId($_SESSION['userId']);
                $placeorder->setTotalPrice((float)$totalprice);

                if ($cartItems > 0) {
                    if (!empty($count)) {
                        if ($this->placeorderService->placeOrder($placeorder)) {
                            // $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);

                            for ($i = 0; $i < count($cartItems); $i++) {
                                $ids = $cartItems[$i]->getId();
                                $qty = $cartItems[$i]->getQty();
                                $price = $cartItems[$i]->getEvent_price();
                                
                                $orderItem = new OrdersItem();

                                $orderItem->setOrder_id($placeorder->getId());
                                $orderItem->setProduct_id($ids);
                                $orderItem->setQty($qty);
                                $orderItem->setPrice($price * $qty);
                                
                                $this->placeorderService->placeOneOrderItem($orderItem);
                            }
                            echo "<script>alert('Order placed successfully! ')</script>";
                        } else {
                            echo "<script>alert('Failed to place order. ')</script>";
                        }
                    } else {
                        echo "<script>alert('No products in the shopping cart! Please add products to the cart first!')</script>";
                        echo "<script>window.location = '/event/jazzevents'</script>";
                    }
                }

                //if order was placed and all order items were placed - delete everything from cart where userid = this.userid(session(usserid))

            }
        }
    }
}
