<?php
// test if forms are empty

function errorsForm(array $post): array
{
    $errors = [];
    if (empty($post['title'])){
        $errors['title'] = "Le champ title est vide ";
    }

    if (empty($post['content'])){
        $errors['content'] = "Le champ content est vide ";
    }

    if (empty($post['author'])){
        $errors['author'] = "Le champ author est vide ";
    }

    return $errors;
}