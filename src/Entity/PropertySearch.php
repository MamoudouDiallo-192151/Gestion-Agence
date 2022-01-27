<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * Undocumented variable
     *
     * @var int|null
     */
    private $maxPrice;

    /**
     * Undocumented variable
     *
     * @var int|null
     * @Assert\Range(min=10, max=400)
     */
    private $minSurface;

    /**
     * Undocumented variable
     *
     * @var ArrayCollection
     */
    private $options;
    public function _construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * Get undocumented variable
     *
     * @return  int|null
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set undocumented variable
     *
     * @param  int|null  $maxPrice  Undocumented variable
     *
     * @return  self
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  int|null
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * Set undocumented variable
     *
     * @param  int|null  $minSurface  Undocumented variable
     *
     * @return  self
     */
    public function setMinSurface($minSurface)
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set undocumented variable
     *
     * @param  ArrayCollection  $options  Undocumented variable
     *
     * @return  self
     */
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }
}
