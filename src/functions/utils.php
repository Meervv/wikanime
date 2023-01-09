<?php
    function generateRandomUsername() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $usernameLength = 8; //longueur du nom d'utilisateur
        $randomUsername = ''; //initialise la variable qui contiendra le nom de l'utilisateur générré aléatoirement

        for ($i = 0; $i < $usernameLength; $i++) { //boucle qui génère le nom d'utilisateur
            $randomUsername .= $characters[rand(0, strlen($characters) - 1)]; //ajoute un caractère aléatoire à la variable $randomUsername
        }
        return $randomUsername;
    }
?>