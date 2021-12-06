<?php

namespace scsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Coeficiente;
use scsBundle\Form\CoeficienteType;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Coeficiente controller.
 *
 */
class CoeficienteController extends Controller
{
    /**
     * Lists all Coeficiente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $coeficientes = $em->getRepository('scsBundle:Coeficiente')->findAll();

        return $this->render('coeficiente/index.html.twig', array(
            'coeficientes' => $coeficientes,
        ));
    }

    /**
     * Creates a new Coeficiente entity.
     *
     */
    public function newAction(Request $request)
    {
        $coeficiente = new Coeficiente();
        $coeficiente->setFecha($coeficiente->getMes().' '.$coeficiente->getAno());

        $form=$this->createFormBuilder(null, array(
            'data_class' => 'scsBundle\Entity\Coeficiente',
            'constraints' => array(
                new Assert\Callback(array($coeficiente, 'validateCoeficiente'))
            )))
            ->add('mes', 'choice', array(
                'choices' => array(
                    'Enero' => 'Enero',
                    'Febrero' => 'Febrero',
                    'Marzo'=>'Marzo',
                    'Abril' => 'Abril',
                    'Mayo' => 'Mayo',
                    'Junio' => 'Junio',
                    'Julio' => 'Julio',
                    'Agosto' => 'Agosto',
                    'Septiembre' => 'Septiembre',
                    'Octubre' => 'Octubre',
                    'Noviembre' => 'Noviembre',
                    'Diciembre' => 'Diciembre',
                )
            ))
            ->add('ano','choice', array(
                'choices' => array(
                    '2015'=>'2015',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    '2022'=>'2022',
                    '2023'=>'2023',
                    '2024'=>'2024',
                    '2025'=>'2025',
                )
            ))
            ->add('cuc')
            ->add('cup')->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coeficiente->setFecha($coeficiente->getMes().' '.$coeficiente->getAno());
            $em = $this->getDoctrine()->getManager();
            $em->persist($coeficiente);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Coeficiente salaial añadido correctamente');
            return $this->redirectToRoute('prenomina_index');
        }

        return $this->render('coeficiente/new.html.twig', array(
            'coeficiente' => $coeficiente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Coeficiente entity.
     *
     */
    public function showAction(Coeficiente $coeficiente)
    {
        $deleteForm = $this->createDeleteForm($coeficiente);

        return $this->render('coeficiente/show.html.twig', array(
            'coeficiente' => $coeficiente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Coeficiente entity.
     *
     */
    public function editAction(Request $request, Coeficiente $coeficiente)
    {
        $deleteForm = $this->createDeleteForm($coeficiente);
        $editForm = $this->createForm(new CoeficienteType(), $coeficiente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coeficiente);
            $em->flush();

            return $this->redirectToRoute('coeficiente_edit', array('id' => $coeficiente->getId()));
        }

        return $this->render('coeficiente/edit.html.twig', array(
            'coeficiente' => $coeficiente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Coeficiente entity.
     *
     */
    public function deleteAction(Request $request, Coeficiente $coeficiente)
    {
        $form = $this->createDeleteForm($coeficiente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coeficiente);
            $em->flush();
        }

        return $this->redirectToRoute('coeficiente_index');
    }

    /**
     * Creates a form to delete a Coeficiente entity.
     *
     * @param Coeficiente $coeficiente The Coeficiente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Coeficiente $coeficiente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coeficiente_delete', array('id' => $coeficiente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function validateCoeficiente(Coeficiente $coeficiente, ExecutionContextInterface $context)
    {
        $conflicts = $this->getDoctrine()
            ->getRepository('scsBundle:Coeficiente')
            ->findBydate($coeficiente->getMes(), $coeficiente->getAno())
        ;

        if ($conflicts != null) {
            $context->addViolationAt(
                'mes',
                'Existe un coeficiente salarial para ese período'
            );
        }
    }

}
