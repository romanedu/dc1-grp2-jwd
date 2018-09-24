<?php

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