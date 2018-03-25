<?php
/**
 * Created by PhpStorm.
 * User: vilca
 * Date: 24/03/18
 * Time: 03:18
 */

require 'connec.php';
include 'header.php';

$pdo = new PDO(DSN, USER, PASS);
$queryArticle = "SELECT * FROM article";
$responseArticle = $pdo->query($queryArticle);
$articles = $responseArticle->fetchAll(PDO::FETCH_ASSOC);


?>

<h1 class="text-center">Mes Articles ! </h1>
<?php foreach($articles as $article) : ?>
    <div class="jumbotron">
        <div class="container">
            <h2><?=$article['title'] ?></h2>
            <p><?=$article['content'] ?></p>
            <blockquote <?=$article['content'] ?>>
                <footer><?=$article['author'] ?></footer>
            </blockquote>
        </div>
        <div class="row">

        </div>
        <form class="" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?= $article['id'] ?>">
            <button class="btn btn-danger btn-lg" type="submit">Delete</button>
        </form>
        <a class="btn btn-primary btn-lg" href="update.php?id=<?=$article['id']?>">Edit</a>

    </div>

<?php endforeach ?>


<?php
include 'footer.php';
?>
