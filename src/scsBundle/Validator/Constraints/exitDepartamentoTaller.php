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
 * Class exitDepartamentoTaller
 * @package Validator\Constraints
 * @Annotations
 */

class exitDepartamentoTaller extends Constraint
{
    public $message = 'Existe un departamento registrado con ese nombre en el taller';


    public function validatedBy(){
        return 'exit_departamento_taller';
    }
}