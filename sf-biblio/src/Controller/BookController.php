<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BookController extends AbstractController
{

    /**
     *@Route("/livres", name="livres")
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
     * @Route("/livre/{id}", name="livre", requirements={"id"="\d+"})
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
     * @Route("/livre/create", name="livre_create")
     */
    //je crées une fonction pour enregistrer un nouveau livre.
    public function createLivre(EntityManagerInterface $entityManager)
    {
        //je instancier un objet de class book
        //puis je t'utilise les methode setTitle.. pour passe les informatins
        // et enregistrer l'instance de la classe Book (l'entité) en BDD
        $livre = new Book();
        $livre->setTitle("L'Instant présent");
        $livre->setAuthor("Guillaume Musso");
        $livre->setNbPages("448");
        $livre->setPublishedAt(new \DateTime('2017-05-05'));

        // une fois l'entité créée, j'utilise la classe EntityManager
        // je demande à Symfony de l'instancier pour moi (grâce au système
        // d'autowire)
        // cette classe me permet de persister mon entité (de préparer sa sauvegarde
        // en bdd), puis d'effectuer l'enregistrement (génère et éxecute une requête SQL)
        $entityManager->persist($livre);
        $entityManager->flush();

        return $this->render("livre_create.html.twig");

    }
}