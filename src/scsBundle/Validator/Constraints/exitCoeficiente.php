<?php
/**
 * Created by PhpStorm.
 * User: Bárbaro
 * Date: 19/05/2016
 * Time: 15:18
 */

namespace scsBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * Class exitPaciente
 * @package Validator\Constraints
 * @Annotations
 */
class exitCoeficiente extends Constraint
{
    public $message = 'Existe un coeficiente salarial registrado para ese período';


    public function validatedBy(){
        return 'exit_coeficiente';
    }
}