<?php

namespace scsBundle\Controller;

use scsBundle\Entity\PrenominaTrabajador;
use scsBundle\Form\Prenomina2Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Prenomina;
use scsBundle\Form\PrenominaType;

/**
 * Prenomina controller.
 *
 */
class PrenominaController extends Controller
{
    /**
     * Lists all Prenomina entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $prenominas = $em->getRepository('scsBundle:Prenomina')->findAll();

        return $this->render('prenomina/index.html.twig', array(
            'prenominas' => $prenominas,
        ));
    }

    /**
     * Creates a new Prenomina entity.
     *
     */
    public function newAction(Request $request)
    {
        $prenomina = new Prenomina();
        $form = $this->createForm(new PrenominaType(), $prenomina);
        $form->handleRequest($request);
        $error=false;
        $em = $this->getDoctrine()->getManager();

        if($form->isSubmitted()){
            $fecha=new \DateTime('01-'.$prenomina->getMes().'-'.$prenomina->getAnno());
            $prenomina->setFecha($fecha);
            $prenomina->setFecha($fecha);
            $existe=$em->getRepository('scsBundle:Prenomina')->findOneBy(array('fecha'=>$fecha,'taller'=>$prenomina->getTaller()));
            if($existe!=null){
                $error=true;
                return $this->render('prenomina/new.html.twig', array(
                    'prenomina' => $prenomina,
                    'form' => $form->createView(),
                    'error'=>$error,
                    'sms'=>'Existe una prenómina registrada para el taller '.$prenomina->getTaller().' en ese período'
                ));
            }

        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($prenomina);
            $em->flush();


            return $this->redirectToRoute('prenomina_new2',array('id'=>$prenomina->getId()) );
        }

        return $this->render('prenomina/new.html.twig', array(
            'prenomina' => $prenomina,
            'form' => $form->createView(),
            'error'=>$error
        ));
    }

    public function new2Action(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $prenomina=$em->getRepository('scsBundle:Prenomina')->find($id);
        $dql='SELECT t, d FROM scsBundle:Trabajador t JOIN t.departamento d WHERE d.taller=:taller ORDER BY t.nombre';
        $query=$em->createQuery($dql);
        $query->setParameter('taller', $prenomina->getTaller());
        $trabajadores=$query->getResult();

        foreach($trabajadores as $trabajador){
                $prenominatrabajador = new PrenominaTrabajador();
                $prenominatrabajador->setTrabajadores($trabajador);
                $prenominatrabajador->setPrenomina($prenomina);
                $prenomina->getPrenominaTrabajador()->add($prenominatrabajador);
        }

        $form=$this->createForm(new Prenomina2Type(), $prenomina);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $trab=$prenomina->getPrenominaTrabajador();

            foreach($trab as $trabajador){
                    $trabajador->setSalarioReal($trabajador->getSalarioDevengado()-$trabajador->getMaestria()-$trabajador->getInterrupciones()-$trabajador->getInstructor()-$trabajador->getDiaFeriado()-$trabajador->getHorasExtras()-$trabajador->getMovilizacion());
                    $trabajador->setSalarioResultado($trabajador->getSalarioReal()*$prenomina->getCup());
                    $trabajador->setTotalResultado($trabajador->getSalarioResultado()*$trabajador->getIndiceEvaluacion());
                    $trabajador->setTotalCobrarcup($trabajador->getSalarioDevengado()+$trabajador->getTotalResultado()+$trabajador->getVacaciones());
                    $trabajador->setTotalCobrarcuc($trabajador->getTotalCobrarcup()*$prenomina->getCuc());

            }
            $em->persist($prenomina);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Prenómina generada correctamente');
            return $this->redirectToRoute('prenomina_show', array('id'=>$prenomina->getId()));
        }

        return $this->render('prenomina/new2.html.twig',
            array('form'=>$form->createView(),
                'prenomina'=>$prenomina
            )

        );


    }


    /**
     * Finds and displays a Prenomina entity.
     *
     */
    public function showAction(Prenomina $prenomina)
    {

        return $this->render('prenomina/show.html.twig', array(
            'prenomina' => $prenomina,
        ));
    }

    public function showcucAction(Prenomina $prenomina)
    {

        return $this->render('prenomina/showcuc.html.twig', array(
            'prenomina' => $prenomina,
        ));
    }

    /**
     * Displays a form to edit an existing Prenomina entity.
     *
     */
    public function editAction(Request $request, Prenomina $prenomina)
    {
        $deleteForm = $this->createDeleteForm($prenomina);
        $editForm = $this->createForm(new PrenominaType(), $prenomina);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prenomina);
            $em->flush();

            return $this->redirectToRoute('prenomina_edit', array('id' => $prenomina->getId()));
        }

        return $this->render('prenomina/edit.html.twig', array(
            'prenomina' => $prenomina,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Prenomina entity.
     *
     */
    public function deleteAction(Prenomina $prenomina)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($prenomina);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Prenómina eliminada correctamente');

        return $this->redirectToRoute('prenomina_index');
    }

    /**
     * Creates a form to delete a Prenomina entity.
     *
     * @param Prenomina $prenomina The Prenomina entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Prenomina $prenomina)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prenomina_delete', array('id' => $prenomina->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
