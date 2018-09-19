<?php

require_once 'config/parameters.php';

$connection = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_pass, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8', lc_time_names = 'fr_FR';",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
        ]);

function getAllPhotos(): array {
    global $connection;

    $query = "SELECT
			photo.*,
			DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                        categorie.libelle AS categorie
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            ORDER BY photo.date_creation DESC
            LIMIT 3;";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getPhoto(int $id): array {
    global $connection;

    $query = "SELECT
                photo.*,
                DATE_FORMAT(photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                categorie.libelle AS categorie
            FROM photo
            INNER JOIN categorie ON photo.categorie_id = categorie.id
            WHERE photo.id = :id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch();
}

/**
 * Récupérer la liste des tags d'une photo
 * @global PDO $connection
 * @param int $id ID de la photo
 * @return array Liste des tags de la photo
 */
function getAllTagsByPhoto(int $id): array {
    global $connection;

    $query = "SELECT
                tag.id,
                tag.libelle
            FROM tag
            INNER JOIN photo_has_tag ON tag.id = photo_has_tag.tag_id
            WHERE photo_has_tag.photo_id = :id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
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

function getAllPhotosbyCategorie(int $id): array {
    global $connection;

    $query = "SELECT
			photo.*,
                        DATE_FORMAT (photo.date_creation, '%e %M %Y') AS 'date_creation_format',
                        categorie.libelle AS categorie
            FROM photo
            INNER JOIN categorie ON categorie.id = photo.categorie_id
            WHERE categorie.id = :id 
            ORDER BY photo.date_creation DESC;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
}