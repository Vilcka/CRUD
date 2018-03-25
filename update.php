<?php

require 'connec.php';
include 'errorsForm.php';
include 'header.php';

$pdo = new PDO(DSN, USER, PASS);
if (!empty($_POST)){
    $errors = errorsForm($_POST);
    if (empty($errors)){
        $queryUpdateArticle = "UPDATE article SET title=:title, author=:author, content=:content WHERE id=:id";
        $prepareUpdateArticle = $pdo->prepare($queryUpdateArticle);
        $prepareUpdateArticle->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $prepareUpdateArticle->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
        $prepareUpdateArticle->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
        $prepareUpdateArticle->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
        $prepareUpdateArticle->execute();

        header('Location: index.php');
        exit();


    }
}


if (!empty($_GET['id']) && preg_match("/[0-9]{1,2}/",$_GET['id'])){
    $querySelectArticle = "SELECT * FROM article WHERE id=:id";
    $prepareSelectArticle = $pdo->prepare($querySelectArticle);
    $prepareSelectArticle->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $prepareSelectArticle->execute();
    $article = $prepareSelectArticle->fetch(PDO::FETCH_ASSOC);
}else {
    header('Location: errors404.php');
    exit();
}

?>

<form action="" method="post" role="form">
    <legend>Edition de l'article</legend>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?=$article['title'] ?>" placeholder="Input...">
        <?php if(isset($errors['title'])) :?>
            <p class="alert alert-danger"><?=$errors['title']?> </p>
        <?php endif; ?>

    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author" id="author" value="<?=$article['author'] ?>" placeholder="Input...">
        <?php if(isset($errors['author'])) :?>
            <p class="alert alert-danger"><?=$errors['author']?> </p>
        <?php endif; ?>

    </div>
    <div class="form-group">
        <textarea class="form-control" name="content" id="content" cols="30" rows="5"><?=$article['content'] ?></textarea>
        <?php if(isset($errors['content'])) :?>
            <p class="alert alert-danger"><?=$errors['content']?> </p>
        <?php endif; ?>
    </div>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?=$article['id'] ?>">
        <button type="submit" class="btn btn-primary">Ajout</button>
    </form>
</form>


<?php

include 'footer.php';

?>
