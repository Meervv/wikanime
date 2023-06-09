<?php

namespace App\Data;

use App\Entity\Genre;

class SearchData {
    /**
     * @var string
     */
    public $nom;

    /**
     * @var Genre[]
     */
    public $genres;

    /**
     * @var string
     */
    public $theme;
}

?>