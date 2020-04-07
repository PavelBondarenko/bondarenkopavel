<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<!-- Username: JLbqqq10PA

Database name: JLbqqq10PA

Password: tCK4XHKltO

Server: remotemysql.com

Port: 3306 -->



<body>
    <?php
    include('conect.php');
    include('smile.php');

    $per_page=10;
    $result = $mysqli->query('SELECT * FROM `table2`');
    $a = $result->fetch_array();
    $num_pages = ceil($a[0] / $per_page);
    echo  " Количество записей:$a[0]";
    $result = $mysqli->query("SELECT * FROM `table2` Order by id DESC limit $_GET[sum],  $per_page");
    echo "<table border = '2'>\n";
    while ($row = $result->fetch_object()) {
        echo "<tr>";
        echo "<td><b>" . smile($row->text)  . "</td> <td> </b><i>$row->name</i><br></td>";
        echo "</tr>";
    }
    // $a = $mysqli->query("SELECT COUNT(1) FROM `table2`");
    // $b = mysqli_fetch_array( $a );
    // echo  " Количество записей: $b[0]";
    echo "</table>\n";

    echo "<a href='index.php'>1</a>";
    for ($i = $per_page,   $i = $i + $per_page; $i++) {
      echo "<a href='page.php?sum=$i'></a>";
    }
    $result->free();
    $mysqli->close();
    ?>
    <form action="add.php" method="POST">
        <textarea name="text" cols="30" rows="10"></textarea> <br>
        <input type="text" name="name"><br>
        <input type="submit" value="ok">
    </form>
</body>

</html>