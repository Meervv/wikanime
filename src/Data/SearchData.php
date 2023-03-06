<?php

namespace App\Data;

use App\Entity\Anime;
class SearchData {
    public $nom;
    public $genre;
    public $theme;
    public $mangaka;

    /**
     * @var Anime[]
    */
    public $genres = [];

}

?>