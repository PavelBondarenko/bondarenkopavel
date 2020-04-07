<?php
session_start();

include('config.php');
include('conect.php');
include('smile.php');

if (!(isset($_SESSION['bantime']) && ($_SESSION['bantime'] > time()))) {

    if (censor($_POST['text'])) {
        $mysqli->query(
            "INSERT INTO `table2` VALUES(null, '$_POST[text]', '$_POST[name]' ) "
        );
    } else {
        $_SESSION['bantime'] = time() + 30;
    }
}
$mysqli->close();
Header('Location: index.php');