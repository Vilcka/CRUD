<?php

require 'connec.php';

include 'header.php';
include 'errorsForm.php';

$pdo = new PDO(DSN, USER, PASS);
if (!empty($_POST)){
    $errors = errorsForm($_POST);
    if (empty($errors)){
        $queryInsert = "INSERT INTO article (title, content, author) VALUES (:title, :content, :author)";
        $addArticle = $pdo->prepare($queryInsert);
        $addArticle->bindValue(':title', trim($_POST['title']), PDO::PARAM_STR);
        $addArticle->bindValue(':content', trim($_POST['content']), PDO::PARAM_STR);
        $addArticle->bindValue(':author', trim($_POST['author']), PDO::PARAM_STR);
        $addArticle->execute();

        header('Location: index.php');
        exit();
    }

    var_dump($errors);
}


?>

<form action="" method="post" role="form">
    <legend>Ajout de formulaire</legend>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php if(!empty($_POST['title']) && !empty($errors)) echo $_POST['title']; ?>" placeholder="Input...">
        <?php if(isset($errors['title'])) :?>
            <p class="alert alert-danger"><?=$errors['title']?> </p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author" id="author" value="<?php if(!empty($_POST['author']) && !empty($errors)) echo $_POST['author']; ?>" placeholder="Input...">
        <?php if(isset($errors['author'])) :?> echo $errors['title'];
            <p class="alert alert-danger"><?=$errors['author']?> </p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="content" id="content" cols="30" rows="5"><?php if(!empty($_POST['content']) && !empty($errors)) echo $_POST['content']; ?></textarea>
        <?php if(isset($errors['content'])) :?> echo $errors['title'];
            <p class="alert alert-danger"><?=$errors['content']?> </p>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Ajout</button>
</form>


<?php
include 'footer.php';
?>
