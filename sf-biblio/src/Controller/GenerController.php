<?php

namespace App\Controller;



use App\Repository\BookRepository;
use App\Repository\GenerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenerController extends AbstractController
{

    /**
     *@Route("/gener/{id}", name="gener")
     */
    public function Geners($id, GenerRepository $generRepository)
    {
        $genre = $generRepository->find($id);


        return $this->render("gener.html.twig", ['genre' => $genre]);
    }
}