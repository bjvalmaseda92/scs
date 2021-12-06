<?php

namespace scsBundle\Controller;

use scsBundle\Form\UsuarioEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $authUtil=$this->get('security.authentication_utils');
        $last_username= $authUtil->getLastUsername();
        $error = $authUtil->getLastAuthenticationError();

        return $this->render('usuario/login.html.twig', array(
            'last_username'=>$last_username,
            'error'=>$error));
    }


    public function profileAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $usuario=$em->getRepository('scsBundle:Usuario')->find($id);
        $passwordOriginal = $usuario->getPassword();



        $form=$this->createForm(new UsuarioEditType(), $usuario);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()) {
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
            $em->flush();
            $this->get('session')->getFlashBag()->add('success',
                'Los cambios se han guardado con éxito'
            );

            return $this->redirect($this->generateUrl('scs_homepage'));
        }
            return $this->render('usuario/profile.html.twig', array(
                'usuario'      => $usuario,
                'form'   => $form->createView(),
            ));
        }

}
