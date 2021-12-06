<?php

namespace scsBundle\Controller;

use scsBundle\Form\UsuarioEditAdminType;
use scsBundle\Form\UsuarioEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use scsBundle\Entity\Usuario;
use scsBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller
{
    /**
     * Lists all Usuario entities.
     *
     */
    public function indexAction()
    {

        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('scs_homepage');
        }else{
            $em = $this->getDoctrine()->getManager();

            $usuarios = $em->getRepository('scsBundle:Usuario')->findAll();

            return $this->render('usuario/index.html.twig', array(
                'usuarios' => $usuarios,
            ));
        }
    }

    /**
     * Creates a new Usuario entity.
     *
     */
    public function newAction(Request $request)
    {  if(!$this->get('security.context')->isGranted('ROLE_ADMIN')){
        return $this->redirectToRoute('scs_homepage');
    }else {
        $usuario = new Usuario();
        $form = $this->createForm(new UsuarioType(), $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
            $usuario->setSalt(md5(time()));

            $passwordCodificado = $encoder->encodePassword(
                $usuario->getPassword(),
                $usuario->getSalt()
            );

            $usuario->setPassword($passwordCodificado);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Usuario creado correctamente');

            return $this->redirectToRoute('usuarios_index');
        }

        return $this->render('usuario/new.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
        ));
    }
    }

    /**
     * Finds and displays a Usuario entity.
     *
     */
    public function showAction(Usuario $usuario)
    {
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('scs_homepage');
        }else{
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('usuario/show.html.twig', array(
            'usuario' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));}
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     */
    public function editAction(Request $request, Usuario $usuario)
    {
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')){
        return $this->redirectToRoute('scs_homepage');
    }else{
        $editForm = $this->createForm(new UsuarioEditAdminType(), $usuario);
        $editForm->handleRequest($request);
        $passwordOriginal = $usuario->getPassword();


        if ($editForm->isValid()) {
            if (null == $usuario->getPassword()) {
                $usuario->setPassword($passwordOriginal);
            } else {
                $encoder = $this->get('security.encoder_factory')
                    ->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword(
                    $usuario->getPassword(),
                    $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Los cambios se han guardado correctamente');
            return $this->redirectToRoute('usuarios_index');
        }

        return $this->render('usuario/edit.html.twig', array(
            'usuario' => $usuario,
            'edit_form' => $editForm->createView(),
        ));}
    }

    /**
     * Deletes a Usuario entity.
     *
     */
    public function deleteAction(Usuario $usuario)
    {
        if(!$this->get('security.context')->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('scs_homepage');
        }else{
        $em = $this->getDoctrine()->getManager();
        $em->remove($usuario);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Usuario eliminado con éxito');
        return $this->redirectToRoute('usuarios_index');
    }}

    /**
     * Creates a form to delete a Usuario entity.
     *
     * @param Usuario $usuario The Usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuarios_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
