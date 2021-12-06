<?php

namespace scsBundle\Controller;

use scsBundle\Entity\Prenomina;
use scsBundle\Util\Util;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PDFController extends Controller
{
    public function usuariosAction()
    {
        $em=$this->getDoctrine()->getManager();
        $usuarios=$em->getRepository('scsBundle:Usuario')->findBy(array(),array('usuario'=>'ASC'));

        $html= $this->renderView('pdf/usuarios.html.twig', array('usuarios'=>$usuarios));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Informe de Usuarios SCS Confecciones Trebol.pdf"'
            )
        );
    }


    public function categoriasAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorias=$em->getRepository('scsBundle:Categoria')->findBy(array(),array('nombre'=>'ASC'));

        $html= $this->renderView('pdf/categorias.html.twig', array('categorias'=>$categorias));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Categorías ocupacionales SCS Confecciones Trebol.pdf"'
            )
        );
    }

    public function escalaAction()
    {
        $em=$this->getDoctrine()->getManager();
        $escalas=$em->getRepository('scsBundle:Escala')->findBy(array(),array('nombre'=>'ASC'));

        $html= $this->renderView('pdf/escalas.html.twig', array('escalas'=>$escalas));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Escalas salariales SCS Confecciones Trebol.pdf"'
            )
        );
    }

    public function tallerAction()
    {
        $em=$this->getDoctrine()->getManager();
        $talleres=$em->getRepository('scsBundle:Taller')->findBy(array(),array('nombre'=>'ASC'));

        $html= $this->renderView('pdf/talleres.html.twig', array('talleres'=>$talleres));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Talleres SCS Confecciones Trebol.pdf"'
            )
        );
    }

    public function departamentoAction()
    {
        $em=$this->getDoctrine()->getManager();
        $departamentos=$em->getRepository('scsBundle:Departamento')->findBy(array(),array('taller'=>'ASC'));

        $html= $this->renderView('pdf/departamentos.html.twig', array('departamentos'=>$departamentos));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Departamentos SCS Confecciones Trebol.pdf"'
            )
        );
    }

    public function trabajadoresAction()
    {
        $em=$this->getDoctrine()->getManager();
        $trabajadores=$em->getRepository('scsBundle:Trabajador')->findBy(array(),array('departamento'=>'ASC'));

        $html= $this->renderView('pdf/trabajadores.html.twig', array('trabajadores'=>$trabajadores));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Trabajadores SCS Confecciones Trebol.pdf"'
            )
        );
    }

    public function relacionesAction()
    {
        $em=$this->getDoctrine()->getManager();
        $producciones=$em->getRepository('scsBundle:TallerProduccion')->findBy(array(),array('fecha'=>'ASC'));

        $html= $this->renderView('pdf/relaciones.html.twig', array('producciones'=>$producciones));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Relaciones Plan/Real de la producción SCS Confecciones Trebol.pdf"'
            )
        );
    }

    public function salariosAction()
    {
        $em=$this->getDoctrine()->getManager();
        $salarios=$em->getRepository('scsBundle:BaseCalculo')->findBy(array(),array('fecha'=>'ASC'));

        $html= $this->renderView('pdf/salarios.html.twig', array('salarios'=>$salarios));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Salario Base de Cálculo por períodos SCS Confecciones Trebol.pdf"'
            )
        );
    }


    public function graficarAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $talleres=$em->getRepository('scsBundle:Taller')->findAll();


        $inicio=explode('-', $request->query->get('inicio'));
        $fin=explode('-',$request->query->get('fin'));


        $fecha1=new \DateTime($inicio[0].'-'.$inicio[1].'-1');
        $fecha2=new \DateTime($fin[0].'-'.$fin[1].'-1');
        $otra=new \DateTime($inicio[0].'-'.$inicio[1].'-1');

        if(!Util::comparar($fecha1,$fecha2)){
            $this->get('session')->getFlashBag()->add('error', 'El perído seleccionado no es válido');
            return $this->redirectToRoute('tallerproduccion_graficar');
        }



        $ejeX=array($otra);
        $cantidad=array($fecha1->format('dmY')=>0);


        $interval=new \DateInterval('P1M');
        do{
            $fecha1->add($interval);
            $date=new \DateTime($fecha1->format('d-m-Y'));
            $ejeX[]=$date;
            $cantidad[$date->format('dmY')]=0;

        }while($fecha1->format('dmY')!=$fecha2->format('dmY'));

        foreach($ejeX as $x) {
            $produccion = $em->getRepository('scsBundle:TallerProduccion')->findOneBy(array('fecha' => $x));
            if ($produccion != null){
                $cantidad[$x->format('dmY')] = $produccion->getSalarioformador();
            }
        }


        $html= $this->renderView('pdf/graficar.html.twig', array(
            'talleres'=>$talleres,
            'ejeX'=>$ejeX,
            'cantidad'=>$cantidad,
            'inicio'=>$otra->format('m-Y'),
            'fin'=>$fecha2->format('m-Y')
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Grafico de salario formador por perídos SCS Confecciones Trebol.pdf"'
            )
        );
    }


    public function prenominaCUPAction(Prenomina $prenomina)
    {

        $html= $this->renderView('pdf/prenominaCUP.html.twig', array(
            'prenomina' => $prenomina,
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Prenómina CUP del'.$prenomina->getTaller().' '.Util::mesString($prenomina->getMes()).' '.$prenomina->getAnno().'.pdf"'
            )
        );

    }

    public function prenominaCUCAction(Prenomina $prenomina)
    {

        $html= $this->renderView('pdf/prenominaCUC.html.twig', array(
            'prenomina' => $prenomina,
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Prenómina CUC del'.$prenomina->getTaller().' '.Util::mesString($prenomina->getMes()).' '.$prenomina->getAnno().'.pdf"'
            )
        );
    }

}
