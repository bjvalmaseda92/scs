<?php

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Usuario
 * @UniqueEntity("usuario", message="Existe un usuario registrado con este nombre")
 * @UniqueEntity("correo", message="El correo ya existe")
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="scsBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
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
     * @Assert\Regex(pattern="/[A-Z|Á|É|Í|Ó|Ú]{1}[a-z|á|é|í|ó|ú|A-Z|Á|É|Í|Ó|Ú|\s]{1,254}/", message="El nombre debe comenzar con mayúscula")
     * @Assert\NotBlank(message = "El campo no puede estar vacío")
     */
    private $nombre;

    /**
     * @var string
     * @Assert\Regex(pattern="/[A-Z|Á|É|Í|Ó|Ú]{1}[a-z|á|é|í|ó|ú|A-Z|Á|É|Í|Ó|Ú|\s]{1,254}/", message="Los apellidos deben comenzar con mayúscula")
     * @ORM\Column(name="apellidos", type="string", length=255)
     * @Assert\NotBlank(message = "El campo no puede estar vacío")
     */
    private $apellidos;

    /**
     * @var string
     * @Assert\Regex(pattern="/[a-z]{3,255}/", message="El nombre de usuario solo puede contener caracteres alfabéticos")
     * @ORM\Column(name="usuario", type="string", length=255)
     * @Assert\NotBlank(message = "El campo no puede estar vacío")
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255)
     * @Assert\NotBlank(message = "El campo no puede estar vacío")
     * @Assert\Email(message="El correo no es válido")
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="rol", type="string", length=255)
     * @Assert\NotBlank(message = "El campo no puede estar vacío")
     */
    private $rol;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)     *
     */
    private $password;


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
     * @return Usuario
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     *
     * @return Usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Usuario
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set rol
     *
     * @param string $rol
     *
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return array($this->rol);
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->usuario;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    public function __toString(){
        return $this->nombre.' '.$this->apellidos;
    }
}
