<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use scsBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * TallerProduccion
 *
 * @ORM\Table(name="taller_produccion")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\TallerProduccionRepository")
 */
class TallerProduccion
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
     * @ORM\Column(name="anno", type="string", length=255)
     */
    private $anno;


    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="plan", type="float")
     */
    private $plan;

    /**
     * @var float
     *
     * @ORM\Column(name="preal", type="float")
     */
    private $preal;
    /**
     * @var float
     *
     * @ORM\Column(name="salarioformador", type="float")
     */
    private $salarioformador;

    /**
     * @var float
     *
     * @ORM\Column(name="relacionplan", type="float")
     */
    private $relacionplan;

    /**
     * @var float
     *
     * @ORM\Column(name="relacionreal", type="float")
     */
    private $relacionreal;


    /**
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Taller", inversedBy="produccion")
     * @Assert\NotBlank()
     */

    private $taller;

    public function __construct()
    {
        $this->plan = 0;
        $this->Real = 0;
        $this->salarioformador = 0;
        $this->relacionplan = 0;
        $this->relacionreal = 0;
    }



    /**
     * Get id
     *
     * @return integer
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
     * @return TallerProduccion
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
     * @param string $anno
     *
     * @return TallerProduccion
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return string
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TallerProduccion
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
     * Set plan
     *
     * @param float $plan
     *
     * @return TallerProduccion
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return float
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set preal
     *
     * @param float $preal
     *
     * @return TallerProduccion
     */
    public function setPreal($preal)
    {
        $this->preal = $preal;

        return $this;
    }

    /**
     * Get preal
     *
     * @return float
     */
    public function getPreal()
    {
        return $this->preal;
    }

    /**
     * Set salarioformador
     *
     * @param float $salarioformador
     *
     * @return TallerProduccion
     */
    public function setSalarioformador($salarioformador)
    {
        $this->salarioformador = $salarioformador;

        return $this;
    }

    /**
     * Get salarioformador
     *
     * @return float
     */
    public function getSalarioformador()
    {
        return $this->salarioformador;
    }

    /**
     * Set relacionplan
     *
     * @param float $relacionplan
     *
     * @return TallerProduccion
     */
    public function setRelacionplan($relacionplan)
    {
        $this->relacionplan = $relacionplan;

        return $this;
    }

    /**
     * Get relacionplan
     *
     * @return float
     */
    public function getRelacionplan()
    {
        return $this->relacionplan;
    }

    /**
     * Set relacionreal
     *
     * @param float $relacionreal
     *
     * @return TallerProduccion
     */
    public function setRelacionreal($relacionreal)
    {
        $this->relacionreal = $relacionreal;

        return $this;
    }

    /**
     * Get relacionreal
     *
     * @return float
     */
    public function getRelacionreal()
    {
        return $this->relacionreal;
    }

    /**
     * Set taller
     *
     * @param \scsBundle\Entity\Taller $taller
     *
     * @return TallerProduccion
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


    public function mes__toString(){
        return Util::mesString($this->mes);
    }

}
