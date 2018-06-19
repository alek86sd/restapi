<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visits
 *
 * @ORM\Table(name="visits")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VisitsRepository")
 */
class Visits
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="event", type="string", length=255)
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=10)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="datetime", type="string", length=255)
     */
    private $datetime;

    /**
     * @var int
     *
     * @ORM\Column(name="visits_count", type="integer")
     */
    private $visitsCount;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return Visits
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Visits
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set datetime
     *
     * @param string $datetime
     *
     * @return Visits
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return string
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set visitsCount
     *
     * @param integer $visitsCount
     *
     * @return Visits
     */
    public function setVisitsCount($visitsCount)
    {
        $this->visitsCount = $visitsCount;

        return $this;
    }

    /**
     * Get visitsCount
     *
     * @return int
     */
    public function getVisitsCount()
    {
        return $this->visitsCount;
    }
}

