<?php
class Session {
    private int $id; 
    private int $restaurantid;
    private string $restaurantname;
    private int $sessions;
    private float $price;
    private float $reducedprice;
    private string $first_session;
    private float $session_length;
    private int $seats;

	public function getId() : int {
		return $this->id;
	}

	public function setId(int $value) {
		$this->id = $value;
	}

	public function getRestaurantname() : string {
		return $this->restaurantname;
	}

	public function setRestaurantname(string $value) {
		$this->restaurantname = $value;
	}

	public function getSessions() : int {
		return $this->sessions;
	}

	public function setSessions(int $value) {
		$this->sessions = $value;
	}

	public function getPrice() : float {
		return $this->price;
	}

	public function setPrice(float $value) {
		$this->price = $value;
	}

	public function getReducedprice() : float {
		return $this->reducedprice;
	}

	public function setReducedprice(float $value) {
		$this->reducedprice = $value;
	}

	public function getFirst_session() : string {
		return $this->first_session;
	}

	public function setFirst_session(string $value) {
		$this->first_session = $value;
	}

	public function getSession_length() : float {
		return $this->session_length;
	}

	public function setSession_length(float $value) {
		$this->session_length = $value;
	}

	public function getSeats() : int {
		return $this->seats;
	}

	public function setSeats(int $value) {
		$this->seats = $value;
	}

	public function getRestaurantid() : int {
		return $this->restaurantid;
	}

	public function setRestaurantid(int $value) {
		$this->restaurantid = $value;
	}
}