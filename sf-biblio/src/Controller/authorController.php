<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class authorController extends AbstractController
{

    /**
     * @Route("/authors", name="authors")
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
        return $this->render('authors.html.twig', ['authors' => $authors]);
    }

    /**
     * @Route("/author/{id}", name="author", requirements={"id"="\d+"})
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
        return $this->render('author.html.twig', ['author' => $author]);
    }

    /**
     * @Route("author/create" , name="author_create")
     */
    //je crées une fonction pour enregistrer un nouveau auteur.
    public function createAuthor()
    {

        //je instancier un objet de class Author
        //puis je t'utilise les methode setTitle... pour passe les informatins
        // et enregistrer l'instance de la classe Author (l'entité) en BDD
        $author = new Author();
        $author->setFirtName('Françoise');
        $author->setLastName('BOURDIN');
        dump($author); die;
    }

}