<?php

namespace App\Classe;

use App\Entity\Genre;
use App\Entity\Book;


class Search
{
    /**
     * @var string
     */
    public $string = '';

    /**
     * @var Genre[]
     */
    public $name = [];
    
    /**
     * @var Book[]
     */
    public $title = [];
}