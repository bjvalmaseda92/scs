<?php
/**
 * Created by PhpStorm.
 * User: Bárbaro
 * Date: 19/05/2016
 * Time: 15:07
 */

namespace scsBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;



class exitDepartamentoTallerValidator extends ConstraintValidator
{

    private $doctrine;

    /**
     * exitPacienteValidator constructor.
     * @param $doctrine
     */
    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }


    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        $data=explode('-', $value);

        $em=$this->doctrine->getManager();

        $dql = 'SELECT c FROM scsBundle:Departamento d WHERE d.nombre = :nombre AND d.taller =:taller';
        $query = $em->createQuery($dql);
        $query->setParameter('nombre', $data[0]);
        $query->setParameter('taller', $em->getRepository('scsBundle:Taller')->find($data[1]));
        $departamento = $query->getResult();

        if ($departamento!=null){
            $this->context->addViolation($constraint->message, array(), null);
        }

}
}
