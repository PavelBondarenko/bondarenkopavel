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
} // дали значение переменной


echo $_SESSION['col']++;

echo "<br>";

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
<!-- <body>
    <?php
    include('config.php');
    include('conect.php');
    include('smile.php');

    $pagecount = ceil($a / $pagessize);

    $currientpage = $_GET['page'] ?? 1;

    $startrow = ($currientpage - 1)  *  $pagessize;

    $pageination = "<div class= 'pageination'>";
    $result = $mysqli->query('SELECT COUNT(*) FROM `table2` ');
    $a = $result->fetch_array();
    $num_pages = ceil($a[0] / $per_page);
    echo  " Количество записей:$a[0]";
    $result = $mysqli->query("SELECT * FROM `table2`  LIMIT  $startrow, $pagessize");
    echo "<table border = '1'>\n";

    while ($row = $result->fetch_object()) {
      echo "<tr>";
      echo "<td><b>" . smile($row->text)  . "</td> <td> </b><i>$row->name</i><br></td>";
      echo "</tr>";
    }
    // $a = $mysqli->query("SELECT COUNT(1) FROM `table2`");
    // $b = mysqli_fetch_array( $a );
    // echo  " Количество записей:$b[0]";
    echo "</table>\n";
    // echo "<a href='index.php'>1</a>\t\n";
    for ($i = 1; $i <= $pageination; $i++) {
      $pageination .= "<a href = '?page=$i'> $i</a>";
    }

    // for ($i = $per_page, $c = 2;  $c <= $num_pages; $i = $i + $per_page, $c++) {

    //   echo "<a href='page.php?sum=$i'>$c</a>\t";
    // }
    $result->free();
    $mysqli->close();
    ?>
    <form action="add.php" method="POST">
        <textarea name="text" cols="30" rows="10"></textarea> <br>
        <input type="text" name="name"><br>
        <input type="submit" value="ok">
    </form>
</body> -->