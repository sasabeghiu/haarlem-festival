<?php

class tourGuide implements JsonSerializable {

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public int $id;
    public string $name;
    public string $description;
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
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
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

}