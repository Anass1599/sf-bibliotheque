<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminBookController extends AbstractController
{

    /**
     *@Route("/admin/livres", name="admin_livres")
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
        return $this->render("admin/livres.html.twig", ['livres' => $livres]);
    }

    /**
     * je créé une route (donc une page)
     * dans une annotation. Je lui associe l'url "/home" qui
     * est la page d'accueil.
     * Ma route va appeler la méthode home, car l'annotation
     * est placée au dessus de la méthode
     * @Route("/admin/livre/{id}", name="admin_livre", requirements={"id"="\d+"})
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
        return $this->render("admin/livre.html.twig", ['book' => $livre]);
    }

    /**
     * @Route("/admin/livre/create", name="admin_livre_create")
     */
    //je crées une fonction pour enregistrer un nouveau livre.
    public function createLivre()
    {
        //je instancier un objet de class book
        $book = new Book();

        //Ensuite je utilise la méthode createForm() de la classe
        // AbstractController dont notre contrôleur hérite pour créer le formulaire.
        // En premier paramètre, j'envie le chemin de la class BookTyps sur la quel le formulaire est basé,
        // puis en deuxième parametre  l'instance book qui va contenir les données.
        //symfony fait la connexion entre le formulaire et l'intance book.
        $form = $this->createForm(BookType::class, $book);


        return $this->render("admin/livre_create.html.twig", ['form' => $form->createView()]);

    }

    /**
     * @Route("/admin/livre/update/{id}", name="admin_livre_update")
     */
    //je crée une fonction pour modifier les info d'un livre.
    public function updateLivre($id, BookRepository $bookRepository,EntityManagerInterface $entityManager)
    {
        // j'utilise la méthode find de la classe BookRepository
        // pour récupérer un livre de la table book avec $id recupere de l'url.
        $book = $bookRepository->find($id);
        //avec la methode set Title je modifier le contenu.
        $book->setTitle("Win 3");
        //puis J'enregisttre l'instance de la classe Book (l'entité) en BDD avec les methode
        // de la EntityManagerInterface.
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render("admin/livre_update.html.twig");

    }

    /**
     * @Route("/admin/livre/delete/{id}", name="admin_livre_delete")
     */
    public function deleteLivre($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        // j'utilise la méthode find de la classe BookRepository
        // pour récupérer un livre de la table book avec $id recupere de l'url.
        $book = $bookRepository->find($id);

        //je utilise les methode remove() et flush pour préparer et executer
        //la suppression de l'instance de la classe Book (l'entité) en BDD.
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute("admin_livres");

    }
}