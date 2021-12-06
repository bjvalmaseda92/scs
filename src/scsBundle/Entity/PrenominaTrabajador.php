<?php
/**
 * Created by PhpStorm.
 * User: Bárbaro
 * Date: 26/05/2016
 * Time: 11:27
 */

namespace scsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * PrenoniminaTrabajador
 *
 * @ORM\Table(name="prenominatrabajador")
 * @ORM\Entity()
 */

class PrenominaTrabajador
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
     * @ORM\Column(name="salario_devengado", type="float")
     */
    private $salario_devengado;

    /**
     * @var float
     *
     * @ORM\Column(name="maestria", type="float")
     */
    private $maestria;

    /**
     * @var float
     *
     * @ORM\Column(name="interrupciones", type="decimal")
     */
    private $interrupciones;

    /**
     * @var float
     *
     * @ORM\Column(name="instructor", type="float")
     */
    private $instructor;

    /**
     * @var float
     *
     * @ORM\Column(name="dia_feriado", type="float")
     */
    private $dia_feriado;



    /**
     * @var float
     *
     * @ORM\Column(name="horas_extras", type="float")
     */
    private $horas_extras;

    /**
     * @var float
     *
     * @ORM\Column(name="indice_evaluacion", type="float")
     */
    private $indice_evaluacion;



    /**
     * @var float
     *
     * @ORM\Column(name="movilizacion", type="float")
     */
    private $movilizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="penalizacion", type="string", length=20, nullable=true)
     */
    private $penalizacion;


    /**
     * @var float
     *
     * @ORM\Column(name="vacaciones", type="float")
     */
    private $vacaciones;

    /**
     * @var float
     *
     * @ORM\Column(name="salario_real", type="float")
     */
    private $salario_real=0;

    /**
     * @var float
     *
     * @ORM\Column(name="salario_resultado", type="float")
     */
    private $salario_resultado=0;

    /**
     * @var float
     *
     * @ORM\Column(name="total_resultado", type="float")
     */
    private $total_resultado=0;



    /**
     * @var float
     *
     * @ORM\Column(name="total_cobrarcuc", type="float")
     */
    private $total_cobrarcuc=0;

    /**
     * @var float
     *
     * @ORM\Column(name="total_cobrarcup", type="float")
     */
    private $total_cobrarcup=0;


    /**
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Trabajador", inversedBy="prenominaTrabajador")
     */
    private $trabajadores;

    /**
     * @ORM\ManyToOne(targetEntity="scsBundle\Entity\Prenomina", inversedBy="prenominaTrabajador")
     */
    private $prenomina;

    /**
     * PrenominaTrabajador constructor.
     * @param float $salario_devengado
     * @param float $maestria
     * @param float $interrupciones
     * @param float $instructor
     * @param float $dia_feriado
     * @param float $horas_extras
     * @param float $indice_evaluacion
     * @param float $movilizacion
     * @param string $penalizacion
     * @param float $vacaciones
     * @param float $salario_real
     * @param float $salario_resultado
     * @param float $total_resultado
     * @param float $total_cobrarcuc
     * @param float $total_cobrarcup
     * @param $trabajadores
     * @param $prenomina
     */
    public function __construct()
    {
        $this->salario_devengado =0;
        $this->maestria = 0;
        $this->interrupciones = 0;
        $this->instructor = 0;
        $this->dia_feriado = 0;
        $this->horas_extras = 0;
        $this->indice_evaluacion = 0;
        $this->movilizacion = 0;
        $this->penalizacion = ' ';
        $this->vacaciones = 0;
        $this->salario_real = 0;
        $this->penalizacion="";
        $this->salario_resultado = 0;
        $this->total_resultado = 0;
        $this->total_cobrarcuc = 0;
        $this->total_cobrarcup = 0;

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
     * Set salarioDevengado
     *
     * @param float $salarioDevengado
     *
     * @return PrenominaTrabajador
     */
    public function setSalarioDevengado($salarioDevengado)
    {
        $this->salario_devengado = $salarioDevengado;

        return $this;
    }

    /**
     * Get salarioDevengado
     *
     * @return float
     */
    public function getSalarioDevengado()
    {
        return $this->salario_devengado;
    }

    /**
     * Set maestria
     *
     * @param float $maestria
     *
     * @return PrenominaTrabajador
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
     * Set interrupciones
     *
     * @param float $interrupciones
     *
     * @return PrenominaTrabajador
     */
    public function setInterrupciones($interrupciones)
    {
        $this->interrupciones = $interrupciones;

        return $this;
    }

    /**
     * Get interrupciones
     *
     * @return float
     */
    public function getInterrupciones()
    {
        return $this->interrupciones;
    }

    /**
     * Set instructor
     *
     * @param float $instructor
     *
     * @return PrenominaTrabajador
     */
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;

        return $this;
    }

    /**
     * Get instructor
     *
     * @return float
     */
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * Set diaFeriado
     *
     * @param float $diaFeriado
     *
     * @return PrenominaTrabajador
     */
    public function setDiaFeriado($diaFeriado)
    {
        $this->dia_feriado = $diaFeriado;

        return $this;
    }

    /**
     * Get diaFeriado
     *
     * @return float
     */
    public function getDiaFeriado()
    {
        return $this->dia_feriado;
    }

    /**
     * Set horasExtras
     *
     * @param float $horasExtras
     *
     * @return PrenominaTrabajador
     */
    public function setHorasExtras($horasExtras)
    {
        $this->horas_extras = $horasExtras;

        return $this;
    }

    /**
     * Get horasExtras
     *
     * @return float
     */
    public function getHorasExtras()
    {
        return $this->horas_extras;
    }

    /**
     * Set indiceEvaluacion
     *
     * @param float $indiceEvaluacion
     *
     * @return PrenominaTrabajador
     */
    public function setIndiceEvaluacion($indiceEvaluacion)
    {
        $this->indice_evaluacion = $indiceEvaluacion;

        return $this;
    }

    /**
     * Get indiceEvaluacion
     *
     * @return float
     */
    public function getIndiceEvaluacion()
    {
        return $this->indice_evaluacion;
    }

    /**
     * Set movilizacion
     *
     * @param float $movilizacion
     *
     * @return PrenominaTrabajador
     */
    public function setMovilizacion($movilizacion)
    {
        $this->movilizacion = $movilizacion;

        return $this;
    }

    /**
     * Get movilizacion
     *
     * @return float
     */
    public function getMovilizacion()
    {
        return $this->movilizacion;
    }

    /**
     * Set penalizacion
     *
     * @param string $penalizacion
     *
     * @return PrenominaTrabajador
     */
    public function setPenalizacion($penalizacion)
    {
        $this->penalizacion = $penalizacion;

        return $this;
    }

    /**
     * Get penalizacion
     *
     * @return string
     */
    public function getPenalizacion()
    {
        return $this->penalizacion;
    }

    /**
     * Set vacaciones
     *
     * @param float $vacaciones
     *
     * @return PrenominaTrabajador
     */
    public function setVacaciones($vacaciones)
    {
        $this->vacaciones = $vacaciones;

        return $this;
    }

    /**
     * Get vacaciones
     *
     * @return float
     */
    public function getVacaciones()
    {
        return $this->vacaciones;
    }

    /**
     * Set salarioReal
     *
     * @param float $salarioReal
     *
     * @return PrenominaTrabajador
     */
    public function setSalarioReal($salarioReal)
    {
        $this->salario_real = $salarioReal;

        return $this;
    }

    /**
     * Get salarioReal
     *
     * @return float
     */
    public function getSalarioReal()
    {
        return $this->salario_real;
    }

    /**
     * Set salarioResultado
     *
     * @param float $salarioResultado
     *
     * @return PrenominaTrabajador
     */
    public function setSalarioResultado($salarioResultado)
    {
        $this->salario_resultado = $salarioResultado;

        return $this;
    }

    /**
     * Get salarioResultado
     *
     * @return float
     */
    public function getSalarioResultado()
    {
        return $this->salario_resultado;
    }

    /**
     * Set totalResultado
     *
     * @param float $totalResultado
     *
     * @return PrenominaTrabajador
     */
    public function setTotalResultado($totalResultado)
    {
        $this->total_resultado = $totalResultado;

        return $this;
    }

    /**
     * Get totalResultado
     *
     * @return float
     */
    public function getTotalResultado()
    {
        return $this->total_resultado;
    }

    /**
     * Set salarioFormador
     *
     * @param float $salarioFormador
     *
     * @return PrenominaTrabajador
     */
    public function setSalarioFormador($salarioFormador)
    {
        $this->salario_formador = $salarioFormador;

        return $this;
    }

    /**
     * Get salarioFormador
     *
     * @return float
     */
    public function getSalarioFormador()
    {
        return $this->salario_formador;
    }

    /**
     * Set salarioFormadorPlan
     *
     * @param float $salarioFormadorPlan
     *
     * @return PrenominaTrabajador
     */
    public function setSalarioFormadorPlan($salarioFormadorPlan)
    {
        $this->salario_formador_plan = $salarioFormadorPlan;

        return $this;
    }

    /**
     * Get salarioFormadorPlan
     *
     * @return float
     */
    public function getSalarioFormadorPlan()
    {
        return $this->salario_formador_plan;
    }

    /**
     * Set salarioFormadorReal
     *
     * @param float $salarioFormadorReal
     *
     * @return PrenominaTrabajador
     */
    public function setSalarioFormadorReal($salarioFormadorReal)
    {
        $this->salario_formador_real = $salarioFormadorReal;

        return $this;
    }

    /**
     * Get salarioFormadorReal
     *
     * @return float
     */
    public function getSalarioFormadorReal()
    {
        return $this->salario_formador_real;
    }

    /**
     * Set totalCobrar
     *
     * @param float $totalCobrar
     *
     * @return PrenominaTrabajador
     */
    public function setTotalCobrar($totalCobrar)
    {
        $this->total_cobrar = $totalCobrar;

        return $this;
    }

    /**
     * Get totalCobrar
     *
     * @return float
     */
    public function getTotalCobrar()
    {
        return $this->total_cobrar;
    }

    /**
     * Set trabajadores
     *
     * @param \scsBundle\Entity\Trabajador $trabajadores
     *
     * @return PrenominaTrabajador
     */
    public function setTrabajadores(\scsBundle\Entity\Trabajador $trabajadores = null)
    {
        $this->trabajadores = $trabajadores;

        return $this;
    }

    /**
     * Get trabajadores
     *
     * @return \scsBundle\Entity\Trabajador
     */
    public function getTrabajadores()
    {
        return $this->trabajadores;
    }

    /**
     * Set prenomina
     *
     * @param \scsBundle\Entity\Prenomina $prenomina
     *
     * @return PrenominaTrabajador
     */
    public function setPrenomina(\scsBundle\Entity\Prenomina $prenomina = null)
    {
        $this->prenomina = $prenomina;

        return $this;
    }

    /**
     * Get prenomina
     *
     * @return \scsBundle\Entity\Prenomina
     */
    public function getPrenomina()
    {
        return $this->prenomina;
    }

    /**
     * Set totalCobrarcuc
     *
     * @param float $totalCobrarcuc
     *
     * @return PrenominaTrabajador
     */
    public function setTotalCobrarcuc($totalCobrarcuc)
    {
        $this->total_cobrarcuc = $totalCobrarcuc;

        return $this;
    }

    /**
     * Get totalCobrarcuc
     *
     * @return float
     */
    public function getTotalCobrarcuc()
    {
        return $this->total_cobrarcuc;
    }

    /**
     * Set totalCobrarcup
     *
     * @param float $totalCobrarcup
     *
     * @return PrenominaTrabajador
     */
    public function setTotalCobrarcup($totalCobrarcup)
    {
        $this->total_cobrarcup = $totalCobrarcup;

        return $this;
    }

    /**
     * Get totalCobrarcup
     *
     * @return float
     */
    public function getTotalCobrarcup()
    {
        return $this->total_cobrarcup;
    }
}
