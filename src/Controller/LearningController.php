<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class LearningController extends AbstractController
{

    /**
     * @Route("/aboutMe", name="aboutMe")
     * @param SessionInterface $session
     * @return Response
     */
    public function aboutMe(SessionInterface $session): Response
    {
        if ($session->get('name')) {
            $name = $session->get('name');
            return $this->render('learning/aboutMe.html.twig', ['name' => $name,]);
        } else {
            return $this->forward('App\Controller\LearningController::showMyName');
        }
    }

    /**
     * @Route("/", name="showMyName")
     * @param SessionInterface $session
     * @return Response
     */
    public function showMyName(SessionInterface $session): Response
    {
        if ($session->get('name')) {
            $name = $session->get('name');
        } else {
            $name = 'unknown';
        }

        //from
        $task = new Task();
        $form = $this->createFormBuilder($task)
            ->setAction($this->generateUrl('changeMyName'))
            ->setMethod('POST')
            ->add('name', TextType::class, ['attr' => ['placeholder' => 'Enter your name']])
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();
        return $this->render('learning/showMyName.html.twig', [
            'name' => $name,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/changeMyName", name="changeMyName", methods={"POST","HEAD"})
     * @param Request $request
     * @param SessionInterface $session
     * @return RedirectResponse
     */
    public function changeMyName(Request $request, SessionInterface $session): Response
    {
        $form = $request->request->get('form');
        $session->set('name', $form['name']);
        $this->render('learning/changeMyName.html.twig', [
            'name' => $form['name'],
        ]);
        return $this->redirectToRoute('showMyName');


    }

}
