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

    public function getById($orderId)
    {
        return $this->orderRepository->getById($orderId);
    }

    public function addPayment($orderId, $paymentId)
    {
        return $this->orderRepository->addPayment($orderId, $paymentId);
    }

    public function getOrderItemsByOrderId($orderId)
    {
        return $this->orderRepository->getOrderItemsByOrderId($orderId);
    }

    public function cancelOrder($userId)
    {
        return $this->orderRepository->cancelOrder($userId);
    }
}
