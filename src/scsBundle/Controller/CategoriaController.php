<?php

namespace scsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Categoria;
use scsBundle\Form\CategoriaType;

/**
 * Categoria controller.
 *
 */
class CategoriaController extends Controller
{
    /**
     * Lists all Categoria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('scsBundle:Categoria')->findAll();

        return $this->render('categoria/index.html.twig', array(
            'categorias' => $categorias,
        ));
    }

    /**
     * Creates a new Categoria entity.
     *
     */
    public function newAction(Request $request)
    {
        $categoria = new Categoria();
        $form = $this->createForm(new CategoriaType(), $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Categoría añadida correctamente');

            return $this->redirectToRoute('categoria_index');
        }

        return $this->render('categoria/new.html.twig', array(
            'categoria' => $categoria,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoria entity.
     *
     */
    public function showAction(Categoria $categoria)
    {
        $deleteForm = $this->createDeleteForm($categoria);

        return $this->render('categoria/show.html.twig', array(
            'categoria' => $categoria,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoria entity.
     *
     */
    public function editAction(Request $request, Categoria $categoria)
    {
        $editForm = $this->createForm(new CategoriaType(), $categoria);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Los cambios se han guardado correctamente');


            return $this->redirectToRoute('categoria_index');
        }

        return $this->render('categoria/edit.html.twig', array(
            'categoria' => $categoria,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Categoria entity.
     *
     */
    public function deleteAction($id) {

            $em = $this->getDoctrine()->getManager();
            $categoria=$em->getRepository('scsBundle:Categoria')->find($id);
            $em->remove($categoria);
            $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Categoría eliminada correctamente');

        return $this->redirectToRoute('categoria_index');
    }

    /**
     * Creates a form to delete a Categoria entity.
     *
     * @param Categoria $categoria The Categoria entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categoria $categoria)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoria_delete', array('id' => $categoria->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
