<?php

namespace scsBundle\Controller;

use scsBundle\Util\Util;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\TallerProduccion;
use scsBundle\Form\TallerProduccionType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * TallerProduccion controller.
 *
 */
class TallerProduccionController extends Controller
{
    /**
     * Lists all TallerProduccion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tallerProduccions = $em->getRepository('scsBundle:TallerProduccion')->findAll();

        return $this->render('tallerproduccion/index.html.twig', array(
            'tallerProduccions' => $tallerProduccions,
        ));
    }

    /**
     * Creates a new TallerProduccion entity.
     *
     */
    public function newAction(Request $request)
    {
        $tallerProduccion = new TallerProduccion();
        $form = $this->createForm(new TallerProduccionType(), $tallerProduccion);
        $form->handleRequest($request);


        $error=false;
        $error2=false;
        $em = $this->getDoctrine()->getManager();

        if($form->isSubmitted()) {
            $fecha = new \DateTime('01-' . $tallerProduccion->getMes() . '-' . $tallerProduccion->getAnno());
            $tallerProduccion->setFecha($fecha);
            $existe = $em->getRepository('scsBundle:TallerProduccion')->findOneBy(array('fecha' => $fecha, 'taller' => $tallerProduccion->getTaller()));
            if ($existe != null) {
                $error = true;
                return $this->render('tallerproduccion/new.html.twig', array(
                    'tallerProduccion' => $tallerProduccion,
                    'form' => $form->createView(),
                    'error' => $error,
                    'error2' => $error2,
                    'sms' => 'Existe una relación de producción para ese período'
                ));
            }

            $existe = $em->getRepository('scsBundle:Prenomina')->findOneBy(array('fecha' => $fecha, 'taller' => $tallerProduccion->getTaller()));
            if ($existe == null) {
                $error2 = true;
                return $this->render('tallerproduccion/new.html.twig', array(
                    'tallerProduccion' => $tallerProduccion,
                    'form' => $form->createView(),
                    'error2' => $error2,
                    'error' => $error,
                    'sms2' => 'No existe prenómina para este taller durante ese período'
                ));
            }
        }
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $consulta=$em->getRepository('scsBundle:Prenomina')->findOneBy(array('taller'=>$tallerProduccion->getTaller(),'fecha'=>$tallerProduccion->getFecha()));

                $prenominas=$consulta->getPrenominaTrabajador();
                foreach($prenominas as $prenomina){
                    $tallerProduccion->setSalarioformador($tallerProduccion->getSalarioformador()+$prenomina->getTotalCobrarcup());
                }

                $tallerProduccion->setRelacionplan($tallerProduccion->getSalarioformador()/$tallerProduccion->getPlan());
                $tallerProduccion->setRelacionreal($tallerProduccion->getSalarioformador()/$tallerProduccion->getPreal());

                $em->persist($tallerProduccion);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Relación de producción añadida correctamente');

                return $this->redirectToRoute('tallerproduccion_index');
            }

        return $this->render('tallerproduccion/new.html.twig', array(
            'tallerProduccion' => $tallerProduccion,
            'form' => $form->createView(),
            'error'=>$error,
            'error2'=>$error2,
        ));
    }



    /**
     * Displays a form to edit an existing TallerProduccion entity.
     *
     */
    public function editAction(Request $request, TallerProduccion $tallerProduccion)
    {

        $editForm = $this->createForm(new TallerProduccionType(), $tallerProduccion);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $error=false;
        $error2=false;
        if($editForm->isSubmitted()) {
            $fecha = new \DateTime('01-' . $tallerProduccion->getMes() . '-' . $tallerProduccion->getAnno());
            $tallerProduccion->setFecha($fecha);

            $dql='SELECT tp FROM scsBundle:TallerProduccion tp WHERE tp.fecha=:fecha AND tp.taller=:taller AND tp.id != :id';
            $query=$em->createQuery($dql);
            $query->setParameter('fecha', $fecha);
            $query->setParameter('taller', $tallerProduccion->getTaller());
            $query->setParameter('id', $tallerProduccion->getId());
            $existe =$query->getResult();

            if ($existe != null) {
                $error = true;
                return $this->render('prenomina/new.html.twig', array(
                    'tallerProduccion' => $tallerProduccion,
                    'form' => $editForm->createView(),
                    'error' => $error,
                    'error2' => $error2,
                    'sms' => 'Existe una relación de producción para ese período'
                ));
            }

            $existe = $em->getRepository('scsBundle:Prenomina')->findOneBy(array('fecha' => $fecha, 'taller' => $tallerProduccion->getTaller()));
            if ($existe == null) {
                $error2 = true;
                return $this->render('tallerproduccion/new.html.twig', array(
                    'tallerProduccion' => $tallerProduccion,
                    'form' => $editForm->createView(),
                    'error2' => $error2,
                    'error' => $error,
                    'sms2' => 'No existe prenómina para este taller durante ese período'
                ));
            }
        }


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $consulta=$em->getRepository('scsBundle:Prenomina')->findOneBy(array('taller'=>$tallerProduccion->getTaller(),'fecha'=>$tallerProduccion->getFecha()));

            $prenominas=$consulta->getPrenominaTrabajador();
            foreach($prenominas as $prenomina){
                $tallerProduccion->setSalarioformador($tallerProduccion->getSalarioformador()+$prenomina->getTotalCobrarcup());
            }

            $tallerProduccion->setRelacionplan($tallerProduccion->getSalarioformador()/$tallerProduccion->getPlan());
            $tallerProduccion->setRelacionreal($tallerProduccion->getSalarioformador()/$tallerProduccion->getPreal());


            $em->persist($tallerProduccion);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Los cambios se han guardado correctamente');
            return $this->redirectToRoute('tallerproduccion_index');
        }

        return $this->render('tallerproduccion/edit.html.twig', array(
            'tallerProduccion' => $tallerProduccion,
            'edit_form' => $editForm->createView(),
            'error'=>$error,
            'error2'=>$error2,
        ));
    }

    /**
     * Deletes a TallerProduccion entity.
     *
     */
    public function deleteAction( TallerProduccion $tallerProduccion)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($tallerProduccion);
            $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Relación de producción eliminada correctamente');

        return $this->redirectToRoute('tallerproduccion_index');
    }


    public function graficarAction(){
        $em=$this->getDoctrine()->getManager();
        $talleres=$em->getRepository('scsBundle:Taller')->findAll();
        return $this->render('tallerproduccion/graficar-get.html.twig', array('talleres'=>$talleres));
    }


    public function graficarPOSTAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $talleres=$em->getRepository('scsBundle:Taller')->findAll();


        $inicio=explode('-', $request->get('inicio'));
        $fin=explode('-',$request->get('fin'));


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


        return $this->render('tallerproduccion/graficar-post.html.twig', array(
            'talleres'=>$talleres,
            'ejeX'=>$ejeX,
            'cantidad'=>$cantidad,
            'inicio'=>$otra->format('Y-m'),
            'fin'=>$fecha2->format('Y-m'),
        ));
    }

}
