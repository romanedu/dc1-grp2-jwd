<?php

require_once __DIR__ . '/../config/parameters.php';

$connection = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_pass, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8', lc_time_names = 'fr_FR';",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
        ]);


$files = glob(__DIR__ . "/entity/*.php");
foreach ($files as $filepath) {
    require_once $filepath;
}

/**
 * Récupérer les données d'une table
 * @global PDO $connection
 * @param string $table Nom de la table
 * @param int $id Identifiant de la ligne
 * @return array Tableau contenant les données retournées par la requête SQL
 */

function getEntity (string $table, int $id) : array {
    global $connection;
    
    $query = "SELECT * FROM $table WHERE id = :id";
    
        $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt ->fetch();
}



function getAllCommentairesByPhoto(int $id): array {
    global $connection;

    $query = "SELECT * 
        FROM commentaire
        WHERE photo_id = :id
        ORDER BY date_creation;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
}

