<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends AbstractController
{

    /**
     * @Route("/admin/authors", name="admin_authors")
     */
    public function authors(AuthorRepository $authorRepository)
    {
        // j'utilise la méthode findAll de la classe AuthorRepository
        // pour récupérer tous les auteurs de la table author
        $authors = $authorRepository->findAll();


        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template
        //et aussi ma variable authors.
        return $this->render('admin/authors.html.twig', ['authors' => $authors]);
    }

    /**
     * @Route("/admin/author/{id}", name="admin_author", requirements={"id"="\d+"})
     */
    public function author($id, AuthorRepository $authorRepository)
    {
        // j'utilise la méthode findAll de la classe AuthorRepository
        // pour récupérer tous les auteurs de la table author
        $author = $authorRepository->find($id);


        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template
        //et aussi ma variable author.
        return $this->render('admin/author.html.twig', ['author' => $author]);
    }

    /**
     * @Route("/admin/author/create" , name="admin_author_create")
     */
    //je crées une fonction pour enregistrer un nouveau auteur.
    public function createAuthor(EntityManagerInterface $entityManager)
    {

        //je instancier un objet de class Author
        //puis je t'utilise les methode setTitle... pour passe les informatins
        // et enregistrer l'instance de la classe Author (l'entité) en BDD
        $author = new Author();
        $author->setFirtName('Harlan');
        $author->setLastName('Coben');

        $entityManager->persist($author);
        $entityManager->flush();

        return $this->render("admin/author_create.html.twig", ['author' => $author]);

    }

    /**
     * @Route("/admin/author/update/{id}", name="admin_author_update")
     */
    //je crée une fonction pour modifier les info d'un author.
    public function updateAuthor($id, AuthorRepository $authorRepository,EntityManagerInterface $entityManager)
    {
        // j'utilise la méthode find de la classe AuthorRepository
        // pour récupérer un auteur de la table author avec $id recupere de l'url.
        $author = $authorRepository->find($id);
        //avec la methode setFirtName je modifier le contenu.
        $author->setFirtName("julie");
        //puis J'enregisttre l'instance de la classe author (l'entité) en BDD avec les methode
        // de la EntityManagerInterface.
        $entityManager->persist($author);
        $entityManager->flush();

        return $this->render("admin/author_update.html.twig", ['author' => $author]);

    }

    /**
     * @Route("/admin/author/delete/{id}", name="admin_author_delete")
     */
    public function deleteAuthor($id,AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        // j'utilise la méthode find de la classe AuthorRepository
        // pour récupérer un auteur de la table author avec $id recupere de l'url.
        $author = $authorRepository->find($id);

        //je utilise les methode remove() et flush pour préparer et executer
        //la suppression de l'instance de la classe Author (l'entité) en BDD.
        $entityManager->remove($author);
        $entityManager->flush();

        return $this->render("admin/author_delete.html.twig", ['author' => $author]);

    }

}