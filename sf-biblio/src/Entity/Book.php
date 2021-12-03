<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
//je cree une class article(php) que doctrine transforme en écriture SQL pour cree ma table.
class Book
{

    //je utilise des annotation pour cree une colonne dans ma table et donner les info.
   /**
    * @ORM\Id()
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue()
    */
   private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_page;

    /**
     * @ORM\Column(type="date")
     */
    private $published_at;


}

