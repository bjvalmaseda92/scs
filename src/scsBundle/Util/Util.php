<?php
/**
 * Created by PhpStorm.
 * User: B�rbaro
 * Date: 15/12/2015
 * Time: 14:20
 */

namespace scsBundle\Util;

class Util
{
    static public function mesString($mes){
        if ($mes==01){
            $mes='Enero';
        } else if ($mes=='02'){
            $mes='Febrero';
        } else if ($mes=='03'){
            $mes='Marzo';
        } else if ($mes=='04'){
            $mes='Abril';
        } else if ($mes=='05'){
            $mes='Mayo';
        } else if ($mes=='06'){
            $mes='Junio';
        } else if ($mes=='07'){
            $mes='Julio';
        } else if ($mes=='08'){
            $mes='Agosto';
        } else if ($mes=='09'){
            $mes='Semptiembre';
        } else if ($mes=='10'){
            $mes='Octubre';
        } else if ($mes=='11'){
            $mes='Noviembre';
        } else if ($mes=='12'){
            $mes='Diciembre';
        }
        return $mes;
    }


    public static function comparar(\DateTime $date1, \DateTime $date2){

        if($date1->format('Y')<$date2->format('Y')){
            return true;
        }elseif($date1->format('Y')==$date2->format('Y')) {
            if ($date1->format('m') < $date2->format('m')) {
                return true;
            } else {
                return false;
            }

        }else{
            return false;
        }
    }

}