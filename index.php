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

    $result = $mysqli->query('SELECT * FROM `table2`');
    echo "<table border = '1'>\n";
    while ($row = $result->fetch_object()) {
        echo "<tr>";
        echo "<td><b>" . smile($row->text)  . "</td> <td> </b><i>$row->name</i><br></td>";
        echo "</tr>";
    }
    $result->free();
    echo "</table>\n";
    $mysqli->close();
    ?>
    <form action="add.php" method="POST">
        <textarea name="text" cols="30" rows="10"></textarea> <br>
        <input type="text" name="name"><br>
        <input type="submit" value="ok">
    </form>
</body>

</html>