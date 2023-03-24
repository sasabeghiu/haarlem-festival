<?php

require __DIR__ . '/../repositories/orderrepository.php';

class OrderService
{
    private $orderRepository;
    private $eventRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        //$this->eventRepository = new EventRepository();
    }

    public function getAll()
    {
        return $this->orderRepository->getAll();
    }


    // for this there is going to be needed a getEventFromOrder query
    //in which after selecting all the events tables you say in the end
    // for example: WHERE orderId = :orderId;
    // this orderId you pass it in the getOrderTotal($orderId)
    
    
    // public function getOrderTotal()
    // {
    //     $total = 0;

    //     foreach ($this->eventRepository->getEventsFromOrder($orderId) as $events) {
    //         $total += floatval($events->price);
    //     }
        
    //     return $total;
    // }
}