<?php
class Reservation {
    private int $id;
    private string $name;
    private int $restaurantID;
    private int $seats;
    private DateTime $time;
    private bool $status;

	public function getId() : int {
		return $this->id;
	}

	public function setId(int $value) {
		$this->id = $value;
	}

	public function getName() : string {
		return $this->name;
	}

	public function setName(string $value) {
		$this->name = $value;
	}

	public function getRestaurantID() : int {
		return $this->restaurantID;
	}

	public function setRestaurantID(int $value) {
		$this->restaurantID = $value;
	}

	public function getSeats() : int {
		return $this->seats;
	}

	public function setSeats(int $value) {
		$this->seats = $value;
	}

	public function getTime() : DateTime {
		return $this->time;
	}

	public function setTime(DateTime $value) {
		$this->time = $value;
	}

	public function getStatus() : bool {
		return $this->status;
	}

	public function setStatus(bool $value) {
		$this->status = $value;
	}
}