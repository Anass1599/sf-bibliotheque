<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
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
    public function createAuthor(EntityManagerInterface $entityManager, Request $request)
    {

        //je instancier un objet de class author
        //puis je cree mon formulaire avec la methode createForm
        //symfony fait la connexion entre le formulaire et l'intance author.
        //je recupere les info dans mon instance request et je les transfert dans mon instance form.
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);


        // Vérifier que le formulaire a été envoyé
        // le isValid empeche que des données invalides par rapports aux types de colonnes
        // soient insérées + prévient les injections SQL
        if($form->isSubmitted() && $form->isValid())
        {
            //puis J'enregisttre l'instance de la classe Book (l'entité) en BDD avec les methode
            // de la class EntityManagerInterface.
            $entityManager->persist($author);
            $entityManager->flush();
        }

        return $this->render("admin/author_create.html.twig", ['form' => $form->createView()]);

    }


    /**
     * @Route("/admin/author/update/{id}", name="admin_author_update")
     */
    //je crée une fonction pour modifier les info d'un author.
    public function updateAuthor($id, AuthorRepository $authorRepository, Request $request, EntityManagerInterface $entityManager)
    {
        // j'utilise la méthode find de la classe BookRepository
        // pour récupérer un auteur de la table author avec $id recupere de l'url.
        //puis je cree mon formulaire avec la methode createForm
        //symfony fait la connexion entre le formulaire et l'intance author.
        //je recupere les info dans mon instance request et je les transfert dans mon instance form.
        $author = $authorRepository->find($id);
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);


        // Vérifier que le formulaire a été envoyé
        // le isValid empeche que des données invalides par rapports aux types de colonnes
        // soient insérées + prévient les injections SQL
        if($form->isSubmitted() && $form->isValid())
        {
            //puis J'enregisttre l'instance de la classe Book (l'entité) en BDD avec les methode
            // de la class EntityManagerInterface.
            $entityManager->persist($author);
            $entityManager->flush();
        }



        return $this->render("admin/author_update.html.twig", ['form' => $form->createView()]);

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

        return $this->redirectToRoute("admin_authors");

    }

}