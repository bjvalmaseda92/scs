<?php

namespace scsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Trabajador;
use scsBundle\Form\TrabajadorType;

/**
 * Trabajador controller.
 *
 */
class TrabajadorController extends Controller
{
    /**
     * Lists all Trabajador entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trabajadors = $em->getRepository('scsBundle:Trabajador')->findAll();

        return $this->render('trabajador/index.html.twig', array(
            'trabajadors' => $trabajadors,
        ));
    }

    /**
     * Creates a new Trabajador entity.
     *
     */
    public function newAction(Request $request)
    {
        $trabajador = new Trabajador();
        $form = $this->createForm(new TrabajadorType(), $trabajador);
        $form->handleRequest($request);

        $em=$this->getDoctrine()->getManager();
        $departamentos=$em->getRepository('scsBundle:Departamento')->findAll();



        if ($form->isSubmitted() && $form->isValid()) {
            $data=explode(' - ', $trabajador->getNombredepartamento());
            $taller=$em->getRepository('scsBundle:Taller')->findOneBy(array('nombre'=>$data[1]));
            $departamento = $em->getRepository('scsBundle:Departamento')->findOneBy(array('nombre'=>$data[0], 'taller'=>$taller));
            $trabajador->setDepartamento($departamento);
            $em->persist($trabajador);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success','Trabajador añadido correctamente');
            return $this->redirectToRoute('trabajador_index');
        }

        return $this->render('trabajador/new.html.twig', array(
            'trabajador' => $trabajador,
            'form' => $form->createView(),
            'departamentos'=>$departamentos
        ));
    }

    /**
     * Finds and displays a Trabajador entity.
     *
     */
    public function showAction(Trabajador $trabajador)
    {
        $deleteForm = $this->createDeleteForm($trabajador);

        return $this->render('trabajador/show.html.twig', array(
            'trabajador' => $trabajador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Trabajador entity.
     *
     */
    public function editAction(Request $request, Trabajador $trabajador)
    {
        $editForm = $this->createForm(new TrabajadorType(), $trabajador);
        $editForm->handleRequest($request);

        $em=$this->getDoctrine()->getManager();
        $departamentos=$em->getRepository('scsBundle:Departamento')->findAll();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $data=explode(' - ', $trabajador->getNombredepartamento());
            $taller=$em->getRepository('scsBundle:Taller')->findOneBy(array('nombre'=>$data[1]));
            $departamento = $em->getRepository('scsBundle:Departamento')->findOneBy(array('nombre'=>$data[0], 'taller'=>$taller));
            $trabajador->setDepartamento($departamento);
            $em = $this->getDoctrine()->getManager();
            $em->persist($trabajador);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success','Los cambios se han guardado correctamente');

            return $this->redirectToRoute('trabajador_index');
        }

        return $this->render('trabajador/edit.html.twig', array(
            'trabajador' => $trabajador,
            'edit_form' => $editForm->createView(),
            'departamentos'=>$departamentos
        ));
    }

    /**
     * Deletes a Trabajador entity.
     *
     */
    public function deleteAction($id)
    {

            $em = $this->getDoctrine()->getManager();
            $trabajador=$em->getRepository('scsBundle:Trabajador')->find($id);
            $em->remove($trabajador);
            $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Trabajador eliminado correctamente');

        return $this->redirectToRoute('trabajador_index');
    }

    /**
     * Creates a form to delete a Trabajador entity.
     *
     * @param Trabajador $trabajador The Trabajador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trabajador $trabajador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trabajador_delete', array('id' => $trabajador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
