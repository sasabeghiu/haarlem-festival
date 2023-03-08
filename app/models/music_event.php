<?php
class Music_Event
{
    //change types 
    private int $id;
    private string $type;
    private string $artist;
    private string $venue;
    private int $ticket_price;
    private int $tickets_available;
    private string $datetime;
    private string $image;
    private string $name;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of artist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set the value of artist
     *
     * @return  self
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get the value of venue
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set the value of venue
     *
     * @return  self
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get the value of ticket_price
     */
    public function getTicket_price()
    {
        return $this->ticket_price;
    }

    /**
     * Set the value of ticket_price
     *
     * @return  self
     */
    public function setTicket_price($ticket_price)
    {
        $this->ticket_price = $ticket_price;

        return $this;
    }

    /**
     * Get the value of ticket_available
     */
    public function getTickets_available()
    {
        return $this->tickets_available;
    }

    /**
     * Set the value of ticket_available
     *
     * @return  self
     */
    public function setTickets_available($tickets_available)
    {
        $this->tickets_available = $tickets_available;

        return $this;
    }

    /**
     * Get the value of datetime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set the value of datetime
     *
     * @return  self
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
