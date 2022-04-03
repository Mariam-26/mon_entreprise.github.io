<?php

// création d'une fonction qui var_dump une variable : très utile pour un tableau
    function jevar_dump($mavariable){ // la fonction nommée avec son paramètre: une variable qu'on va pouvoir modifier pour mettre le nom de celle qu'on veut afficher
        echo "<small class=\"bg-success text-white p-2\">var_dump :</small><pre class=\"alert alert-success w-75\">";
        var_dump($mavariable);
        echo "</pre>";
    }

    function jeprint_r($mavariable){
        echo "<small class=\"bg-primary text-white p-2\">print_r :</small><pre class=\"alert alert-primary w-75\">";
        print_r($mavariable);
        echo "</pre>";
    }