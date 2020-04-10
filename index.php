<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .pageination a {
        color: green;
    }

    .selectedpage {
        color: blue !important;
        font-weight: bold;
    }

    .ban {
        font-size: 93pt;
        color: red;
        transform: rotate(-11deg);
    }
    </style>
</head>
<?php

include("config.php");
include("conect.php");
include("smile.php");

if (!isset($_SESSION['col'])) {
  $_SESSION['col'] = 1;
}
echo  "Количество посещений: " . $_SESSION['col']++;

echo "<br>";

if (!isset($_SESSION['time'])) {
  $_SESSION['time'] = time();
}
if (isset($_SESSION['time'])) {
  $time = time() - $_SESSION['time'];
}
echo  "На сайте:   $time c";

echo "<br>";
// $time_in_site = $time_in_site + date('s', $_SESSION['show_time'] - 60 * 60 * 3);
if (isset($_SESSION['bantime']) && ($_SESSION['bantime'] > time())) {
  echo "<div class= 'ban'>" . "Вы забаненны на: " . ($_SESSION['bantime'] - time()) . "с!" . "</div>";
}

$result_count = $mysqli->query('SELECT count(*) FROM table2'); //считаем количество строк в таблице
$count = $result_count->fetch_array(MYSQLI_NUM)[0];
echo "количество записей: <b>$count</b>";
$result_count->free();
// echo $pagesize;

$pagecount = ceil($count / $pagesize);

$currientpage = $_GET['page'] ?? 1;

$startrow = ($currientpage - 1) * $pagesize;

$pageination = "<div class='pageination'>";

for ($i = 1; $i <= $pagecount; $i++) {
  if ($currientpage == $i) {
    $str = " class='selectedpage'";
  } else {
    $str = "";
  }
  $pageination .= "<a href='?page=$i'$str>$i</a>";
}
$pageination .= "</div>";

$result = $mysqli->query("SELECT * FROM table2 LIMIT $startrow, $pagesize");

echo $pageination;
echo "<table border='1'>\n";
while ($row = $result->fetch_object()) {
  echo "<tr>";
  echo "<td>" . smile($row->text) . "</td>";
  echo "<td>" . $row->name . "</td>";
  echo "</tr>";
}
echo "</table>\n";

echo $pageination;

$result->free();

$mysqli->close();
?>

<body>

    <form action="add.php" method="POST">
        <textarea name="text" cols="30" rows="10"></textarea><br>
        <input type="text" name="name"><br>
        <button type="submit">отправить</button>
    </form>


</body>

</html>