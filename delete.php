<?php

require 'connec.php';
include 'header.php';

$pdo = new PDO(DSN, USER, PASS);

if (!empty($_POST['id'])){
    $queryDelete = "DELETE FROM article WHERE id=:id";
    $delete = $pdo->prepare($queryDelete);
    $delete->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    $delete->execute();

    header('Location: index.php');
    exit();
}

?>

<?php
include 'footer.php';
?>
