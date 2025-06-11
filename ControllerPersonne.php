<?php

require_once '../model/ModelProducteur.php';

class ControllerProducteur {

    // --- page d'acceuil
    public static function caveAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewCaveAccueil.php';
        if (DEBUG)
            echo ("ControllerProducteur : caveAccueil : vue = $vue");
        require ($vue);
    }

    // --- Liste des producteurs
    public static function ProducteurReadAll() {
        $results = ModelProducteur::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewAll.php';
        if (DEBUG)
            echo ("ControllerProducteur : ProducteurReadAll : vue = $vue");
        require ($vue);
    }

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function ProducteurReadId($args) {
        include 'config.php';
        if (DEBUG) echo ("ControllerProducteur:ProducteurReadId:begin:</br>");
        $results = ModelProducteur::getAllId();
        
        $target = $args['target'];
        if (DEBUG) echo ("ControllerProducteur:ProducteurReadId : target = $target</br>");

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewId.php';
        require ($vue);
    }

    // Affiche un producteur particulier (id)
    public static function ProducteurReadOne() {
        $producteur_id = $_GET['id'];
        $results = ModelProducteur::getOne($producteur_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewAll.php';
        require ($vue);
    }

    // Affiche le formulaire de creation d'un producteur
    public static function ProducteurCreate() {

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewInsert.php';
        require ($vue);
    }

    // Affiche un formulaire pour récupérer les informations d'un nouveau producteur.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function ProducteurCreated() {

        // ajouter une validation des informations du formulaire
        $results = ModelProducteur::insert(
                        htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['region'])
        );
        
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewInserted.php';
        require ($vue);
    }
    
        public static function ProducteurDeleted() {

        $producteur_id = $_GET['id'];
        $results = ModelProducteur::delete($producteur_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewDeleted.php';
        require ($vue);}
 

    //--------------------------------------------------------------------
    
    //Sans doublon
    public static function ProducteurSansDoublons() {
        $results = ModelProducteur::getnodouble();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewSansDoublons.php';
        require ($vue);
    }

    //Nb de producteurs par région
    public static function ProducteurRegion() {
        $results = ModelProducteur::getNb();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewRegion.php';
        require ($vue);
    }

}

?>
