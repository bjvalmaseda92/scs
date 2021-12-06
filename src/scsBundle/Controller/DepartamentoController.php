<?php

namespace scsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Departamento;
use scsBundle\Form\DepartamentoType;

/**
 * Departamento controller.
 *
 */
class DepartamentoController extends Controller
{
    /**
     * Lists all Departamento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('scsBundle:Departamento')->findAll();

        return $this->render('departamento/index.html.twig', array(
            'departamentos' => $departamentos,
        ));
    }

    /**
     * Creates a new Departamento entity.
     *
     */
    public function newAction(Request $request)
    {
        $departamento = new Departamento();
        $form = $this->createForm(new DepartamentoType(), $departamento);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $dql = 'SELECT d FROM scsBundle:Departamento d WHERE d.nombre = :nombre AND d.taller =:taller';
        $query = $em->createQuery($dql);
        $query->setParameter('nombre', $departamento->getNombre());
        $query->setParameter('taller', $departamento->getTaller());
        $depart = $query->getResult();
        $error=false;


        if($depart!=null){
            $error=true;
            $errormessage='Existe un departamento registrado con ese nombre en el taller '.$departamento->getTaller();
            return $this->render('departamento/new.html.twig', array(
                'departamento' => $departamento,
                'form' => $form->createView(),
                'error'=>$error,
                'errormassage'=>$errormessage,
            ));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $departamento->getNombre(explode('-',$departamento->getNombre())[0]);
            $departamento->getTaller()->addDepartamento($departamento);
            $em->persist($departamento);
            $em->flush();


            $this->get('session')->getFlashBag()->add('success', 'Departamento añadido correctamente');

            return $this->redirectToRoute('departamento_index');
        }

        return $this->render('departamento/new.html.twig', array(
            'departamento' => $departamento,
            'form' => $form->createView(),
            'error'=>$error
        ));
    }

    /**
     * Finds and displays a Departamento entity.
     *
     */
    public function showAction(Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);

        return $this->render('departamento/show.html.twig', array(
            'departamento' => $departamento,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to edit an existing Departamento entity.
     *
     */
    public function editAction(Request $request, Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);
        $taller=$departamento->getTaller();

        $editForm = $this->createForm(new DepartamentoType(), $departamento);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($taller->getId()!=$departamento->getTaller()->getId()){
                $taller->removeDepartamento($departamento);
                $departamento->getTaller()->addDepartamento($departamento);
            }
            $em->persist($departamento);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Los cambios se han guardado correctamente');


            return $this->redirectToRoute('departamento_index');
        }

        return $this->render('departamento/edit.html.twig', array(
            'departamento' => $departamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Departamento entity.
     *
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $departamento=$em->getRepository('scsBundle:Departamento')->find($id);
        $departamento->getTaller()->removeDepartamento($departamento);
        $em->remove($departamento);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Departamento eliminado correctamente');

        return $this->redirectToRoute('departamento_index');
    }

    /**
     * Creates a form to delete a Departamento entity.
     *
     * @param Departamento $departamento The Departamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departamento $departamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('departamento_delete', array('id' => $departamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
