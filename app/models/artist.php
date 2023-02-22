<?php
class Artist
{
    private int $id;
    private string $name;
    private string $description;
    private string $type;
    private string $headerImg;
    private string $thumbnailImg;

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

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Get the value of headerImg
     */
    public function getHeaderImg()
    {
        return $this->headerImg;
    }

    /**
     * Set the value of headerImg
     *
     * @return  self
     */
    public function setHeaderImg($headerImg)
    {
        $this->headerImg = $headerImg;

        return $this;
    }

    /**
     * Get the value of thumbnailImg
     */
    public function getThumbnailImg()
    {
        return $this->thumbnailImg;
    }

    /**
     * Set the value of thumbnailImg
     *
     * @return  self
     */
    public function setThumbnailImg($thumbnailImg)
    {
        $this->thumbnailImg = $thumbnailImg;

        return $this;
    }
}
