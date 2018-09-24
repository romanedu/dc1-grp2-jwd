<?php

require_once 'model/database.php';

$contenu = $_POST["contenu"];
$photo_id = $_POST["photo_id"];

insertCommentaire($contenu, $photo_id); 

header("Location: photo.php?id=" . $photo_id);