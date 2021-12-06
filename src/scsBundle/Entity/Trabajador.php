<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Trabajador
 *
 * @ORM\Table(name="trabajador")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\TrabajadorRepository")
 */
class Trabajador
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
     * @Assert\Regex(pattern="/[A-Z|Á|É|Í|Ó|Ú]{1}[a-z|á|é|í|ó|ú|A-Z|Á|É|Í|Ó|Ú|\s]{1,254}/", message="El nombre del trabajador debe comenzar con mayúscula")
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $nombre;

    /**
     * @var string
     * @Assert\Regex(pattern="/[A-Z|Á|É|Í|Ó|Ú]{1}[a-z|á|é|í|ó|ú|A-Z|Á|É|Í|Ó|Ú|\s]{1,254}/", message="El nombre del trabajador debe comenzar con mayúscula")
     * @ORM\Column(name="apellido1", type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $apellido1;

    /**
     * @var string
     * @Assert\Regex(pattern="/[A-Z|Á|É|Í|Ó|Ú]{1}[a-z|á|é|í|ó|ú|A-Z|Á|É|Í|Ó|Ú|\s]{1,254}/", message="El nombre del trabajador debe comenzar con mayúscula")
     * @ORM\Column(name="apellido2", type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $apellido2;

    /**
     * @var string
     * @Assert\Regex(pattern="/\d{11}/", message="El número de carnet de identidad no es válido")
     * @ORM\Column(name="ci", type="string", length=11, unique=true)
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $ci;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $direccion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Departamento", inversedBy="trabajadores")
     */
    private $departamento;



    /**
     *
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Categoria", inversedBy="trabajadores")
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $categoria;


    /**
     *
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Escala", inversedBy="trabajadores")
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $escala;

    /**
     * @Assert\NotBlank(message="El campo no puede estar vacío")
     */
    private $nombredepartamento;


    /**
     *
     * @ORM\OneToMany(targetEntity="scsBundle\Entity\PrenominaTrabajador", mappedBy="trabajadores", orphanRemoval=true)
     */
    private $prenominaTrabajador;

    /**
     * @return mixed
     */
    public function getNombredepartamento()
    {
        return $this->nombredepartamento;
    }

    /**
     * @param mixed $nombredepartamento
     */
    public function setNombredepartamento($nombredepartamento)
    {
        $this->nombredepartamento = $nombredepartamento;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Trabajador
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
     * Set apellido1
     *
     * @param string $apellido1
     *
     * @return Trabajador
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     *
     * @return Trabajador
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set ci
     *
     * @param string $ci
     *
     * @return Trabajador
     */
    public function setCi($ci)
    {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get ci
     *
     * @return string
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Trabajador
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }


    /**
     * Set departamento
     *
     * @param \scsBundle\Entity\Departamento $departamento
     *
     * @return Trabajador
     */
    public function setDepartamento(\scsBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \scsBundle\Entity\Departamento
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set categoria
     *
     * @param \scsBundle\Entity\Categoria $categoria
     *
     * @return Trabajador
     */
    public function setCategoria(\scsBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \scsBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set escala
     *
     * @param \scsBundle\Entity\Escala $escala
     *
     * @return Trabajador
     */
    public function setEscala(\scsBundle\Entity\Escala $escala = null)
    {
        $this->escala = $escala;

        return $this;
    }

    /**
     * Get escala
     *
     * @return \scsBundle\Entity\Escala
     */
    public function getEscala()
    {
        return $this->escala;
    }

    public function __toString(){
        return $this->nombre.' '.$this->apellido1.' '.$this->apellido2;
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
     * Add prenominaTrabajador
     *
     * @param \scsBundle\Entity\PrenominaTrabajador $prenominaTrabajador
     *
     * @return Trabajador
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
}
