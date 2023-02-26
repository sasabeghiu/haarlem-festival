<?php

class Event implements JsonSerializable {

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }


    public int $id;
    public string $nameOfTours;
    public int $tickets_available;
    public string $price;
    public string $datetime;
    public ?int $venueID;
    public ?int $image;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->nameOfTours;
    }

    /**
     * @param string $nameOfTours
     */
    public function setName(string $nameOfTours): void
    {
        $this->nameOfTours = $nameOfTours;
    }

    /**
     * @return int
     */
    public function getTicketsAvailable(): int
    {
        return $this->tickets_available;
    }

    /**
     * @param int $tickets_available
     */
    public function setTicketsAvailable(int $tickets_available): void
    {
        $this->tickets_available = $tickets_available;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = round((float)$price, 2);
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->datetime;
    }

    /**
     * @param string $datetime
     */
    public function setDateTime(string $datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return ?int
     */
    public function getVenueID(): ?int
    {
        return $this->venueID;
    }

    /**
     * @param ?int $venueID
     */
    public function setVenueID(?int $venueID): void
    {
        $this->venueID = $venueID;
    }

    /**
     * @return ?int
     */
    public function getImage(): ?int
    {
        return $this->image;
    }

    /**
     * @param ?int $image
     */
    public function setImage(?int $image): void
    {
        $this->image = $image;
    }

    public function getFormattedDate(){
        $date = new DateTime($this->datetime);
        return $date->format('d-m-Y');
    }

}