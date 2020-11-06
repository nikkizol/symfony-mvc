<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LearningController extends AbstractController
{
    /**
     * @Route("/learning", name="learning")
     */
    public function aboutMe(): Response
    {
        return $this->render('learning/aboutMe.html.twig', [
            'name' => 'Nikita',
        ]);
    }

    public function showMyName(): Response
    {
        return $this->render('learning/showMyName.html.twig', [
            'name' => 'UNKNOWN',
        ]);
    }

    public function changeMyName(): Response
    {
        return $this->render('learning/changeMyName.html.twig', [
            'name' => $_POST['new_name'],
        ]);
    }
}
