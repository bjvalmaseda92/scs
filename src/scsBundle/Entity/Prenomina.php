<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use scsBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Prenomina
 *
 * @ORM\Table(name="prenomina")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\PrenominaRepository")
 */
class Prenomina
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
     * @ORM\Column(name="mes", type="string", length=255)
     */
    private $mes;


    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="anno", type="integer", length=4)
     */
    private $anno;


    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Taller", inversedBy="prenomina")
     */
    private $taller;


    /**
     * @var string
     *
     * @ORM\Column(name="cuc", type="float")
     */
    private $cuc;

    /**
     * @var string
     *
     * @ORM\Column(name="cup", type="float")
     */
    private $cup;


    /**
     *
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\PrenominaTrabajador", mappedBy="prenomina", cascade={"persist","remove"})
     */
    private $prenominaTrabajador;


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
     * Set mes
     *
     * @param string $mes
     *
     * @return Prenomina
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return string
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set anno
     *
     * @param integer $anno
     *
     * @return Prenomina
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prenominaTrabajador = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setPrenominaTrabajador($prenominaTrabajador)
    {
        $this->prenominaTrabajador=$prenominaTrabajador;
    }


    /**
     * Get prenominaTrabajador
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrenominaTrabajador()
    {
        return $this->prenominaTrabajador;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Prenomina
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set cuc
     *
     * @param float $cuc
     *
     * @return Prenomina
     */
    public function setCuc($cuc)
    {
        $this->cuc = $cuc;

        return $this;
    }

    /**
     * Get cuc
     *
     * @return float
     */
    public function getCuc()
    {
        return $this->cuc;
    }

    /**
     * Set cup
     *
     * @param float $cup
     *
     * @return Prenomina
     */
    public function setCup($cup)
    {
        $this->cup = $cup;

        return $this;
    }

    /**
     * Get cup
     *
     * @return float
     */
    public function getCup()
    {
        return $this->cup;
    }





    /**
     * Set taller
     *
     * @param \scsBundle\Entity\Taller $taller
     *
     * @return Prenomina
     */
    public function setTaller(\scsBundle\Entity\Taller $taller = null)
    {
        $this->taller = $taller;

        return $this;
    }

    /**
     * Get taller
     *
     * @return \scsBundle\Entity\Taller
     */
    public function getTaller()
    {
        return $this->taller;
    }

    /**
     * Add prenominaTrabajador
     *
     * @param \scsBundle\Entity\PrenominaTrabajador $prenominaTrabajador
     *
     * @return Prenomina
     */
    public function addPrenominaTrabajador(\scsBundle\Entity\PrenominaTrabajador $prenominaTrabajador)
    {
        $this->prenominaTrabajador[] = $prenominaTrabajador;

        return $this;
    }

    /**
     * Remove prenominaTrabajador
     *
     * @param \scsBundle\Entity\PrenominaTrabajador $prenominaTrabajador
     */
    public function removePrenominaTrabajador(\scsBundle\Entity\PrenominaTrabajador $prenominaTrabajador)
    {
        $this->prenominaTrabajador->removeElement($prenominaTrabajador);
    }


    public function  mes__toString(){
        return Util::mesString($this->mes);
    }
}
