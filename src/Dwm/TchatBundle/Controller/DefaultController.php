<?php

namespace Dwm\TchatBundle\Controller;
use Dwm\TchatBundle\Entity\User;
use Dwm\TchatBundle\Entity\Messages;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    /**
     * @Route("/welcome")
     */
    public function indexAction()
    {
        return $this->render('DwmTchatBundle:Default:auth.html.twig');
    }


    /**
     * @Route("/eng")
     * @Template()
     */

    public function engAction(Request $request)
    {
        $cat = new User();
        $form = $this->createFormBuilder($cat)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('email',TextType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice', 'Enregitrement avec Succées'
            );
        }
        return array('f' => $form->createView());

    }


    /**
     * @Route("/auth")
     * @Template()
     */

    public function authAction(Request $request)
    {
    }



    /**
     * @Route("/mess")
     * @Template()
     */
    public function messAction(Request $request)
    {
        $em = $this->getDoctrine();
        $demandes = $em->getRepository('DwmTchatBundle:Messages')->findAll();
        $cat = new Messages();
        $form = $this->createFormBuilder($cat)
            ->add('contenue',TextType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
        }
        return array('f' => $form->createView(),'cat' => $demandes);
    }



    /**
     * @Route("/getmess")
     * @Template()
     */
    public function getmessAction(Request $request)
    {
        //return $this->render('DwmTchatBundle:Default:mess.html.twig');
        $cat = new Messages();
        $form = $this->createFormBuilder($cat)
            ->add('contenue',TextType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
        }
        return array('f' => $form->createView());


    }




}
