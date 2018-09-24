<?php

function insertCommentaire(string $contenu, int $photo_id) {
    global $connection;
    
    $query = "INSERT INTO commentaire (contenu, date_creation, photo_id) VALUES (:contenu, NOW(), :photo_id)";
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':contenu', $contenu);
    $stmt->bindParam(':photo_id', $photo_id);
    $stmt->execute();
}