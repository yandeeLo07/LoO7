<?php

require_once '../model/Model.php';

class ControllerCave {

    // --- page d'accueil
    public static function caveAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewCaveAccueil.php';
        if (DEBUG)
            echo ("ControllerProducteur : caveAccueil : vue = $vue");
        require ($vue);
    }

    public static function mesPropositions() {
        include 'config.php';
        $vue = $root . '/app/view/mespropositions.php';
        if (DEBUG)
            echo ("ControllerProducteur : caveAccueil : vue = $vue");
        require ($vue);
    }

    // --- Liste des producteurs
}

?>