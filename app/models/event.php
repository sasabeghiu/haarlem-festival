<?php

class Event implements JsonSerializable {

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public int $id;
    public int $tickets_available;
    public string $price;
    public DateTime $datetime;
    public int $venue;
    public int $image;

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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return DateTime
     */
    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    /**
     * @param DateTime $datetime
     */
    public function setDatetime(DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return int
     */
    public function getVenue(): int
    {
        return $this->venue;
    }

    /**
     * @param int $venue
     */
    public function setVenue(int $venue): void
    {
        $this->venue = $venue;
    }

    /**
     * @return int
     */
    public function getImage(): int
    {
        return $this->image;
    }

    /**
     * @param int $image
     */
    public function setImage(int $image): void
    {
        $this->image = $image;
    }

}