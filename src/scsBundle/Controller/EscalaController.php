<?php

namespace scsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Escala;
use scsBundle\Form\EscalaType;

/**
 * Escala controller.
 *
 */
class EscalaController extends Controller
{
    /**
     * Lists all Escala entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $escalas = $em->getRepository('scsBundle:Escala')->findAll();

        return $this->render('escala/index.html.twig', array(
            'escalas' => $escalas,
        ));
    }

    /**
     * Creates a new Escala entity.
     *
     */
    public function newAction(Request $request)
    {
        $escala = new Escala();
        $form = $this->createForm(new EscalaType(), $escala);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($escala);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Escala salarial añadida correctamente');

            return $this->redirectToRoute('escalas_index');
        }

        return $this->render('escala/new.html.twig', array(
            'escala' => $escala,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Escala entity.
     *
     */
    public function showAction(Escala $escala)
    {
        $deleteForm = $this->createDeleteForm($escala);

        return $this->render('escala/show.html.twig', array(
            'escala' => $escala,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Escala entity.
     *
     */
    public function editAction(Request $request, Escala $escala)
    {
        $editForm = $this->createForm(new EscalaType(), $escala);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($escala);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Los cambios se han guardado correctamente');
            return $this->redirectToRoute('escalas_index');
        }

        return $this->render('escala/edit.html.twig', array(
            'escala' => $escala,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Escala entity.
     *
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $escala=$em->getRepository('scsBundle:Escala')->find($id);
        $em->remove($escala);
            $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Escala salarial eliminada correctamente');


        return $this->redirectToRoute('escalas_index');
    }

    /**
     * Creates a form to delete a Escala entity.
     *
     * @param Escala $escala The Escala entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Escala $escala)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('escalas_delete', array('id' => $escala->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
