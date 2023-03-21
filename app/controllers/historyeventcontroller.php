<?php

require __DIR__ . '/../services/historyeventservice.php';

class HistoryEventController
{

    private $historyeventService;

    function __construct()
    {
        $this->historyeventService = new HistoryEventService();
    }

    public function index()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['add-to-cart'])) {
            if (isset($_SESSION['shopping-cart'])) {
                $items_array_id = array_column($_SESSION['shopping-cart'], "product_id");
                if (in_array($_POST['product_id'], $items_array_id)) {
                    echo "<script>alert('This product is already in your shopping cart. You can change the quantity in the shopping cart page.')</script>";
                    echo "<script>window.location = '/historyevent'</script>";
                } else {
                    $count = count($_SESSION['shopping-cart']);
                    $items_array = array(
                        'product_id' => $_POST['product_id']
                    );
                    $_SESSION['shopping-cart'][$count] = $items_array;
                }
            } else {
                $items_array = array(
                    'product_id' => $_POST['product_id']
                );
                //Create new session variable
                $_SESSION['shopping-cart'][0] = $items_array;
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
