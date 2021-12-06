<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


// je fais hériter ma classe PageController de la classe AbstractController de Symfony
// ce qui me permet d'utiliser dans ma classe (avec le mot clé $this) des méthodes
// et propriétés définies dans la classe AbstractController
class homeController extends AbstractController
{

    // je créé une propriété privé $books
    // qui contiendra la liste de tous les livres
    // afin d'éviter de répéter cette variable dans toutes les méthodes
    private $books;

    // je créé une méthode constructor, qui sera appelée automatiquement
    // quand la classe sera instanciée
    // Symfony instancie les classes de controller (même si on le voit pas)
    // pour afficher les pages créées dans le controleur
    public function __construct() {

        // je définis la valeur de la propriété livres.
        $this->books = [
            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images-na.ssl-images-amazon.com/images/I/41rDK8Jb1LL._SX312_BO1,204,203,200_.jpg",
                "id" => 1
            ],
            2 => [
                "title" => "Silo",
                "author" => "Tery Hayes",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images.archambault.ca/images/PG/1856/1856375-gf.jpg?404=default&w=400",
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://m.media-amazon.com/images/I/51IgnZIwYRS.jpg",
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images-na.ssl-images-amazon.com/images/I/71yoJZCdSaL.jpg",
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images2.medimops.eu/product/ccc076/M01784700924-large.jpg",
                "id" => 5
            ],
            6 => [
                "title" => "Intuitio",
                "author" => "Laurent Gounelle",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://calmann-levy.fr/sites/default/files/images/livres/couv/9782702182932-001-T.jpeg",
                "id" => 6
            ]

        ];

    }

    /**
     * je créé une route (donc une page)
     * dans une annotation. Je lui associe l'url "/home" qui
     * est la page d'accueil.
     * Ma route va appeler la méthode home, car l'annotation
     * est placée au dessus de la méthode
     * @Route("/home", name="home")
     */
    public function home(BookRepository $bookRepository)
    {

        //je utilise la méthode findBy() pour extrait une portion de mon tableau dans un autre tableau.
        $tabs = $bookRepository->findBy(array(),array('id'=>'DESC'),3,0);
        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template
        //et aussi mon tableau tabs.
        return $this->render("home.html.twig", ['tabs' => $tabs]);
    }

    /**
     *
     * @Route("/livres", name="livres")
     */
    // pour instancier la classe BookRepository
    // j'utilise l'autowire de Symfony
    // et je passe en parametres de la méthode de controleur
    // le nom de la classe "BookRepository" et une variables
    // dans laquelle je veux que symfony m'instancie la classe

    public function livres(BookRepository $bookRepository)
    {

        // j'utilise la méthode findAll de la classe BookRepository
        // pour récupérer tous les livres de la table book

        $livres = $bookRepository->findAll();
        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template
        //et aussi ma variable livre.
        return $this->render("livres.html.twig", ['livres' => $livres]);
    }

    /**
     * je créé une route (donc une page)
     * dans une annotation. Je lui associe l'url "/home" qui
     * est la page d'accueil.
     * Ma route va appeler la méthode home, car l'annotation
     * est placée au dessus de la méthode
     * @Route("/livre/{id}", name="livre")
     */
    public function livre($id,BookRepository $bookRepository)
    {

        $livre = $bookRepository->find($id);
        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template
        //et aussi ma variable livre.
        return $this->render("livre.html.twig", ['book' => $livre]);
    }

    /**
     * @Route("/contact", name="contact")
     */

    public function contact()
    {
        return $this->render("contact.html.twig");
    }

}