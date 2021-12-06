<?php

namespace scsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\BaseCalculo;
use scsBundle\Form\BaseCalculoType;

/**
 * BaseCalculo controller.
 *
 */
class BaseCalculoController extends Controller
{
    /**
     * Lists all BaseCalculo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $baseCalculos = $em->getRepository('scsBundle:BaseCalculo')->findAll();

        return $this->render('basecalculo/index.html.twig', array(
            'baseCalculos' => $baseCalculos,
        ));
    }

    /**
     * Creates a new BaseCalculo entity.
     *
     */
    public function newAction(Request $request)
    {

        $baseCalculo = new BaseCalculo();
        $form = $this->createForm(new BaseCalculoType(), $baseCalculo);
        $form->handleRequest($request);

        $error=false;
        $em = $this->getDoctrine()->getManager();

        if($form->isSubmitted()) {
            $fecha = new \DateTime('01-' . $baseCalculo->getMes() . '-' . $baseCalculo->getAnno());
            $baseCalculo->setFecha($fecha);
            $existe = $em->getRepository('scsBundle:BaseCalculo')->findOneBy(array('fecha' => $fecha, 'taller' => $baseCalculo->getTaller()));
            if ($existe != null) {
                $error = true;
                return $this->render('basecalculo/new.html.twig', array(
                    'tallerProduccion' => $baseCalculo,
                    'form' => $form->createView(),
                    'error' => $error,
                    'sms' => 'Existe un fondo de salario base de cálculo para ese período'
                ));
            }
        }


        if ($form->isSubmitted() && $form->isValid()) {
            $baseCalculo->setBasecalculo($baseCalculo->getFondo()-$baseCalculo->getMaestria()-$baseCalculo->getRendimiento()-$baseCalculo->getOtros());
            $em = $this->getDoctrine()->getManager();
            $em->persist($baseCalculo);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Fondo de salario base de cálculo añadido correctamente');
            return $this->redirectToRoute('basecalculo_index');
        }

        return $this->render('basecalculo/new.html.twig', array(
            'baseCalculo' => $baseCalculo,
            'form' => $form->createView(),
            'error' => $error,
        ));
    }

    /**
     * Finds and displays a BaseCalculo entity.
     *
     */
    public function showAction(BaseCalculo $baseCalculo)
    {
        $deleteForm = $this->createDeleteForm($baseCalculo);

        return $this->render('basecalculo/show.html.twig', array(
            'baseCalculo' => $baseCalculo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BaseCalculo entity.
     *
     */
    public function editAction(Request $request, BaseCalculo $baseCalculo)
    {
        $deleteForm = $this->createDeleteForm($baseCalculo);
        $editForm = $this->createForm(new BaseCalculoType(), $baseCalculo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($baseCalculo);
            $em->flush();

            return $this->redirectToRoute('basecalculo_edit', array('id' => $baseCalculo->getId()));
        }

        return $this->render('basecalculo/edit.html.twig', array(
            'baseCalculo' => $baseCalculo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BaseCalculo entity.
     *
     */
    public function deleteAction(BaseCalculo $baseCalculo)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($baseCalculo);
            $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Fondo de salario base de cálculo eliminado correctamente');


        return $this->redirectToRoute('basecalculo_index');
    }

    /**
     * Creates a form to delete a BaseCalculo entity.
     *
     * @param BaseCalculo $baseCalculo The BaseCalculo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BaseCalculo $baseCalculo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('basecalculo_delete', array('id' => $baseCalculo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
