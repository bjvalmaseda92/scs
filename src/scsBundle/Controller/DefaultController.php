<?php

namespace scsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();

        $trabajadores=count($em->getRepository('scsBundle:Trabajador')->findAll());
        $talleres=count($em->getRepository('scsBundle:Taller')->findAll());

        return $this->render('scsBundle:Default:index.html.twig', array(
            'trabajadores'=>$trabajadores,
            'talleres'=>$talleres
        ));


    }

    public function ayudaAction()
    {


        return $this->render('scsBundle:Default:ayuda.html.twig'
        );


    }
}
