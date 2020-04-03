<?php
include('conect.php');

if (!empty($_POST['text']) && !empty($_POST['name'])) {
    $mysqli->query(
        "INSERT INTO `table2` VALUES(null, '$_POST[text]', '$_POST[name]' ) "

    );
    header('Location: index.php');
}
