<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Escala
 *
 * @ORM\Table(name="escala")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\EscalaRepository")
 * @UniqueEntity("nombre", message="Existe una escala salarial registrada con ese nombre")
 */
class Escala
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     * @Assert\Regex(pattern="/[A-Z]{1,4}/", message="La escala es en números romanos")
     * @Assert\NotBlank(message = "El campo no puede estar vacío" )
     */
    private $nombre;


    /**
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\Trabajador", mappedBy="escala", orphanRemoval=true)
     */
    private $trabajadores;


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
     * @return Escala
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
        $this->trabajadores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add trabajadore
     *
     * @param \scsBundle\Entity\Trabajador $trabajadore
     *
     * @return Escala
     */
    public function addTrabajadore(\scsBundle\Entity\Trabajador $trabajadore)
    {
        $this->trabajadores[] = $trabajadore;

        return $this;
    }

    /**
     * Remove trabajadore
     *
     * @param \scsBundle\Entity\Trabajador $trabajadore
     */
    public function removeTrabajadore(\scsBundle\Entity\Trabajador $trabajadore)
    {
        $this->trabajadores->removeElement($trabajadore);
    }

    /**
     * Get trabajadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrabajadores()
    {
        return $this->trabajadores;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
