<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Taller
 *
 * @ORM\Table(name="taller")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\TallerRepository")
 * @UniqueEntity("nombre", message="Existe un taller registrado con ese nombre")

 */
class Taller
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
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Z|Á|É|Í|Ó|Ú]{1}[a-z|á|é|í|ó|ú|A-Z|Á|É|Í|Ó|Ú|\s]{1,254}/", message="El nombre de la categoría debe comenzar con mayúscula")
     * @Assert\NotBlank(message = "El campo no puede estar vacío")
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\Departamento", mappedBy="taller", orphanRemoval=true)
     */
    private $departamentos;

    /**
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\TallerProduccion", mappedBy="taller", orphanRemoval=true)
     */
    private $produccion;


    /**
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\Prenomina", mappedBy="taller", orphanRemoval=true)
     */
    private $prenomina;

    /**
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\BaseCalculo", mappedBy="taller", orphanRemoval=true)
     */
    private $basecalculo;



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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Taller
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departamentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add departamento
     *
     * @param \scsBundle\Entity\Departamento $departamento
     *
     * @return Taller
     */
    public function addDepartamento(\scsBundle\Entity\Departamento $departamento)
    {
        $this->departamentos[] = $departamento;

        return $this;
    }

    /**
     * Remove departamento
     *
     * @param \scsBundle\Entity\Departamento $departamento
     */
    public function removeDepartamento(\scsBundle\Entity\Departamento $departamento)
    {
        $this->departamentos->removeElement($departamento);
    }

    /**
     * Get departamentos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartamentos()
    {
        return $this->departamentos;
    }

    /**
     * Add produccione
     *
     * @param \scsBundle\Entity\TallerProduccion $produccione
     *
     * @return Taller
     */
    public function addProduccione(\scsBundle\Entity\TallerProduccion $produccione)
    {
        $this->producciones[] = $produccione;

        return $this;
    }

    /**
     * Remove produccione
     *
     * @param \scsBundle\Entity\TallerProduccion $produccione
     */
    public function removeProduccione(\scsBundle\Entity\TallerProduccion $produccione)
    {
        $this->producciones->removeElement($produccione);
    }

    /**
     * Get producciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducciones()
    {
        return $this->producciones;
    }

    public function __toString(){
       return $this->nombre;
    }

    /**
     * Add prenomina
     *
     * @param \scsBundle\Entity\Prenomina $prenomina
     *
     * @return Taller
     */
    public function addPrenomina(\scsBundle\Entity\Prenomina $prenomina)
    {
        $this->prenomina[] = $prenomina;

        return $this;
    }

    /**
     * Remove prenomina
     *
     * @param \scsBundle\Entity\Prenomina $prenomina
     */
    public function removePrenomina(\scsBundle\Entity\Prenomina $prenomina)
    {
        $this->prenomina->removeElement($prenomina);
    }

    /**
     * Get prenomina
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrenomina()
    {
        return $this->prenomina;
    }

    /**
     * Add produccion
     *
     * @param \scsBundle\Entity\TallerProduccion $produccion
     *
     * @return Taller
     */
    public function addProduccion(\scsBundle\Entity\TallerProduccion $produccion)
    {
        $this->produccion[] = $produccion;

        return $this;
    }

    /**
     * Remove produccion
     *
     * @param \scsBundle\Entity\TallerProduccion $produccion
     */
    public function removeProduccion(\scsBundle\Entity\TallerProduccion $produccion)
    {
        $this->produccion->removeElement($produccion);
    }

    /**
     * Get produccion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduccion()
    {
        return $this->produccion;
    }

    /**
     * Add basecalculo
     *
     * @param \scsBundle\Entity\BaseCalculo $basecalculo
     *
     * @return Taller
     */
    public function addBasecalculo(\scsBundle\Entity\BaseCalculo $basecalculo)
    {
        $this->basecalculo[] = $basecalculo;

        return $this;
    }

    /**
     * Remove basecalculo
     *
     * @param \scsBundle\Entity\BaseCalculo $basecalculo
     */
    public function removeBasecalculo(\scsBundle\Entity\BaseCalculo $basecalculo)
    {
        $this->basecalculo->removeElement($basecalculo);
    }

    /**
     * Get basecalculo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBasecalculo()
    {
        return $this->basecalculo;
    }
}
