<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


// je fais hériter ma classe PageController de la classe AbstractController de Symfony
// ce qui me permet d'utiliser dans ma classe (avec le mot clé $this) des méthodes
// et propriétés définies dans la classe AbstractController
class HomeController extends AbstractController
{


    /**
     * je créé une route (donc une page)
     * dans une annotation. Je lui associe l'url "/home" qui
     * est la page d'accueil.
     * Ma route va appeler la méthode home, car l'annotation
     * est placée au dessus de la méthode
     * @Route("/home", name="home")
     */
    public function home(BookRepository $bookRepository, AuthorRepository $authorRepository)
    {

        //je utilise la méthode findBy() pour extrait une portion de mon tableau dans un autre tableau.
        $books = $bookRepository->findBy(array(),array('id'=>'DESC'),3,0);
        $authors = $authorRepository->findBy(array(),array('id'=>'DESC'),3,0);
        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template
        //et aussi mon tableau tabs.
        return $this->render("home.html.twig", ['books' => $books,'authors'=>$authors]);
    }

    /**
     * @Route("/contact", name="contact")
     */

    public function contact()
    {
        return $this->render("contact.html.twig");
    }

}