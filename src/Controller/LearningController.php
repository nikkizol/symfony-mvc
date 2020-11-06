<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LearningController extends AbstractController
{

    public function aboutMe(SessionInterface $session): Response
    {
        if ($session->get('name')) {
            $name = $session->get('name');
        } else {
            return $this->forward('App\Controller\LearningController::showMyName');
        }
        return $this->render('learning/aboutMe.html.twig', [
            'name' => $name,
        ]);
    }

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

    public function changeMyName(SessionInterface $session): Response
    {
        if(isset($_POST['new_name'])) {
            $session->set('name', $_POST['new_name']);
            $this->render('learning/changeMyName.html.twig', [
                'name' => $_POST['new_name'],
            ]);
            return $this->redirectToRoute('showMyName');
        } return $this->redirectToRoute('showMyName');

    }

}
