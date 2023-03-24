<?php
require __DIR__ . '/../services/orderservice.php';

class OrderController
{
    private $orderService;

    function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function index()
    {
        $model = $this->orderService->getAll();

        require __DIR__ . '/../views/order/index.php';
    }
}