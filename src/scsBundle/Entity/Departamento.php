<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Departamento
 *
 * @ORM\Table(name="departamento")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\DepartamentoRepository")
 */
class Departamento
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
     * @Assert\Regex(pattern="/[A-Z|Á|É|Í|Ó|Ú]{1}[a-z|á|é|í|ó|ú|A-Z|Á|É|Í|Ó|Ú|\s]{1,254}/", message="El nombre del departamento debe comenzar con mayúscula")
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Taller", inversedBy="departamentos")
     * @Assert\NotBlank(message="Debe seleccionar un taller")
     */
    private $taller;

    /**
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\Trabajador", mappedBy="departamento", orphanRemoval=true)
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
     * @return Departamento
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
     * Set taller
     *
     * @param \scsBundle\Entity\Taller $taller
     *
     * @return Departamento
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
     * @return Departamento
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


    public function __toString(){
        return $this->nombre.' - '.$this->taller;
    }
}
