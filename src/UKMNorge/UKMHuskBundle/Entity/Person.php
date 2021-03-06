<?php

namespace UKMNorge\UKMHuskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="UKMNorge\UKMHuskBundle\Repository\PersonRepository")
 */
class Person
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
     * @var int
     *
     * @ORM\Column(name="Mobil", type="integer")
     */
    private $mobil;

    /**
     * @var int
     *
     * @ORM\Column(name="Fylke", type="integer")
     */
    private $fylke;

    /**
     * @var int
     *
     * @ORM\Column(name="Kommune", type="integer")
     */
    private $kommune;

    /**
     * @var int
     *
     * @ORM\Column(name="Event", type="integer", nullable=true)
     */
    private $event;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Timestamp", type="datetime")
     */
    private $timestamp;


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
     * Set mobil
     *
     * @param integer $mobil
     *
     * @return Person
     */
    public function setMobil($mobil)
    {
        $this->mobil = $mobil;

        return $this;
    }

    /**
     * Get mobil
     *
     * @return int
     */
    public function getMobil()
    {
        return $this->mobil;
    }

    /**
     * Set kommune
     *
     * @param integer $kommune
     *
     * @return Person
     */
    public function setKommune($kommune)
    {
        $this->kommune = $kommune;

        return $this;
    }

    /**
     * Get kommune
     *
     * @return int
     */
    public function getKommune()
    {
        return $this->kommune;
    }

    /**
     * Set event
     *
     * @param integer $event
     *
     * @return Person
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return int
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Person
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set fylke
     *
     * @param integer $fylke
     *
     * @return Person
     */
    public function setFylke($fylke)
    {
        $this->fylke = $fylke;

        return $this;
    }

    /**
     * Get fylke
     *
     * @return integer
     */
    public function getFylke()
    {
        return $this->fylke;
    }
    
	public function expose() {
       return get_object_vars($this);
   }
}
