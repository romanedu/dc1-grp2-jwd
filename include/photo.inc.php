<article class="col-4 miniature">

    <a href="photo.php?id=<?php echo $photo["id"]; ?>" title="<?php echo $photo["titre"]; ?>">
        <img src="images/<?php echo $photo["img"]; ?>" alt="<?php echo $photo["titre"]; ?>" title="<?php echo $photo["titre"]; ?>">
        <p><?php echo $photo["nb_likes"]; ?> likes</p>
    </a>

    <div class="infos">
        <h3><?php echo $photo["titre"]; ?> 
            <a href ="categorie.php?id=<?php echo $photo["categorie_id"]; ?> ">
                #<?php echo $photo["categorie"]; ?>
            </a>
        </h3>
        <p>
            <?php $liste_tags = getAllTagsByPhoto($photo["id"]); ?>
            <?php foreach ($liste_tags as $tag) : ?>
                # <?php echo $tag["libelle"]; ?>
            <?php endforeach; ?>
        </p>
        <p><?php echo $photo["date_creation_format"]; ?></p>
    </div>

</article>