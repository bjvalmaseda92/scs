<?php

namespace scsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Taller;
use scsBundle\Form\TallerType;

/**
 * Taller controller.
 *
 */
class TallerController extends Controller
{
    /**
     * Lists all Taller entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();//obtenirndo el manager de doctrine o la forma de acceder a la bd

        $tallers = $em->getRepository('scsBundle:Taller')->findAll();//obteniedo todfod los talleres

        return $this->render('taller/index.html.twig', array(
            'tallers' => $tallers,
        ));
    }

    /**
     * Creates a new Taller entity.
     *
     */
    public function newAction(Request $request)
    {
        $taller = new Taller();
        $form = $this->createForm(new TallerType(), $taller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($taller);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Taller añadido correctamente');


            return $this->redirectToRoute('taller_index');
        }

        return $this->render('taller/new.html.twig', array(
            'taller' => $taller,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Taller entity.
     *
     */
    public function showAction(Taller $taller)
    {
        $deleteForm = $this->createDeleteForm($taller);

        return $this->render('taller/show.html.twig', array(
            'taller' => $taller,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Taller entity.
     *
     */
    public function editAction(Request $request, Taller $taller)
    {
        $editForm = $this->createForm(new TallerType(), $taller);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($taller);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Los cambios se han guardado correctamente');

            return $this->redirectToRoute('taller_index');
        }

        return $this->render('taller/edit.html.twig', array(
            'taller' => $taller,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Taller entity.
     *
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $escala=$em->getRepository('scsBundle:Taller')->find($id);
        $em->remove($escala);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Taller eliminado correctamente');


        return $this->redirectToRoute('taller_index');
    }

    /**
     * Creates a form to delete a Taller entity.
     *
     * @param Taller $taller The Taller entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Taller $taller)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('taller_delete', array('id' => $taller->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
