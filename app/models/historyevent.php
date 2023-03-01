<?php

class HistoryEvent implements JsonSerializable {

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

//better make everything private!

    private int $id;
    private string $nameOfTours;
    private int $tickets_available;
    private string $price;
    private string $datetime;
    private ?int $venueID;
    private string $image;
    private ?int $tourguideID;
    private string $tourguideName;
    private string $tourguideDescription;

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
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return ?int
     */
    public function getTourguideID(): ?int
    {
        return $this->tourguideID;
    }

    /**
     * @param ?int $tourguideID
     */

    public function setTourguideID(?int $tourguideID): void
    {
        $this->tourguideID = $tourguideID;
    }

    /**
     * @return string
     */
    public function getTourguideName(): string
    {
        return $this->tourguideName;
    }

    /**
     * @param string $tourguideName
     */
    public function setTourguideName(string $tourguideName): void
    {
        $this->tourguideName = $tourguideName;
    }

    /**
     * @return string
     */
    public function getTourguideDescription(): string
    {
        return $this->tourguideDescription;
    }

    /**
     * @param string $tourguideDescription
     */
    public function setTourguideDescription(string $tourguideDescription): void
    {
        $this->tourguideDescription = $tourguideDescription;
    }

    public function getFormattedDate(){
        $date = new DateTime($this->datetime);
        return $date->format('d-m-Y');
    }

}