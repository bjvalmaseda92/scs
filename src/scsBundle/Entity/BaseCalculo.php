<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use scsBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * BaseCalculo
 *
 * @ORM\Table(name="base_calculo")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\BaseCalculoRepository")
 */
class BaseCalculo
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
     * @var float
     *
     * @ORM\Column(name="fondo", type="float")
     */
    private $fondo;

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
     * @ORM\Column(name="maestria", type="float")
     */
    private $maestria;

    /**
     * @var float
     *
     * @ORM\Column(name="rendimiento", type="float")
     */
    private $rendimiento;

    /**
     * @var float
     *
     * @ORM\Column(name="otros", type="float")
     */
    private $otros;

    /**
     * @var float
     *
     * @ORM\Column(name="basecalculo", type="float")
     */
    private $basecalculo;

    /**
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Taller", inversedBy="basecalculo")
     * @Assert\NotBlank()
     */

    private $taller;

    /**
     * BaseCalculo constructor.
     * @param float $fondo
     * @param float $maestria
     * @param float $rendimiento
     * @param float $otros
     * @param float $basecalculo
     */
    public function __construct()
    {
        $this->fondo = 0;
        $this->maestria = 0;
        $this->rendimiento = 0;
        $this->otros = 0;
        $this->basecalculo = 0;
    }


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
     * Set fondo
     *
     * @param float $fondo
     *
     * @return BaseCalculo
     */
    public function setFondo($fondo)
    {
        $this->fondo = $fondo;

        return $this;
    }

    /**
     * Get fondo
     *
     * @return float
     */
    public function getFondo()
    {
        return $this->fondo;
    }

    /**
     * Set maestria
     *
     * @param float $maestria
     *
     * @return BaseCalculo
     */
    public function setMaestria($maestria)
    {
        $this->maestria = $maestria;

        return $this;
    }

    /**
     * Get maestria
     *
     * @return float
     */
    public function getMaestria()
    {
        return $this->maestria;
    }

    /**
     * Set rendimiento
     *
     * @param float $rendimiento
     *
     * @return BaseCalculo
     */
    public function setRendimiento($rendimiento)
    {
        $this->rendimiento = $rendimiento;

        return $this;
    }

    /**
     * Get rendimiento
     *
     * @return float
     */
    public function getRendimiento()
    {
        return $this->rendimiento;
    }

    /**
     * Set otros
     *
     * @param float $otros
     *
     * @return BaseCalculo
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;

        return $this;
    }

    /**
     * Get otros
     *
     * @return float
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set basecalculo
     *
     * @param float $basecalculo
     *
     * @return BaseCalculo
     */
    public function setBasecalculo($basecalculo)
    {
        $this->basecalculo = $basecalculo;

        return $this;
    }

    /**
     * Get basecalculo
     *
     * @return float
     */
    public function getBasecalculo()
    {
        return $this->basecalculo;
    }

    /**
     * Set taller
     *
     * @param \scsBundle\Entity\Taller $taller
     *
     * @return BaseCalculo
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
     * Set mes
     *
     * @param string $mes
     *
     * @return BaseCalculo
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
     * @return BaseCalculo
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
     * @return BaseCalculo
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


    public function mes__toString(){
        return Util::mesString($this->mes);
    }

}
