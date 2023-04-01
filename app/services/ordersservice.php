<?php

require __DIR__ . '/../repositories/ordersrepository.php';

class OrdersService 
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrdersRepository();
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function getOnePlacedOrder($id)
    {
        return $this->orderRepository->getOnePlacedOrder($id);
    }

    public function updatePlacedOrder($placedorder, $id)
    {
        return $this->orderRepository->updatePlacedOrder($placedorder, $id);
    }

    public function placeOrder(Orders $placeorder)
    {
        return $this->orderRepository->placeOrder($placeorder);
    }

    public function placeOneOrderItem($orderItem)
    {
        return $this->orderRepository->placeOneOrderItem($orderItem);
    }
}