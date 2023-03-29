<?php

require __DIR__ . '/../services/orderscmsservice.php';

class OrdersCmsController
{
    private $placeorderService;

    function __construct()
    {
        $this->placeorderService = new OrdersCmsService();
        session_start();
    }

    public function cms()
    {
        //Functionality editing
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateOrder = $this->placeorderService->getOneOrder($id);
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

            $placedorder = new OrdersCms();

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

        $model = $this->placeorderService->getAll();

        require __DIR__ . '/../views/cms/order/index.php';
    }
}