<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
        return $this->render('learning/showMyName.html.twig', [
            'name' => $name,
        ]);
    }

    /**
     * @Route("/changeMyName", name="changeMyName", methods={"POST","HEAD"})
     * @param SessionInterface $session
     * @return RedirectResponse
     */
    public function changeMyName(SessionInterface $session): Response
    {
        $session->set('name', $_POST['new_name']);
        $this->render('learning/changeMyName.html.twig', [
            'name' => $_POST['new_name'],
        ]);
        return $this->redirectToRoute('showMyName');


    }

}
