<?php
require_once __DIR__.'/../config/database.php';

class Person {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function authenticate($login, $password) {
        $stmt = $this->db->prepare("SELECT * FROM personne WHERE login = ? AND password = ?");
        $stmt->execute([$login, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Autres méthodes pour gérer les personnes...
}
?>