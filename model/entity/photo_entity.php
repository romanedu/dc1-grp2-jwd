<?php

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

