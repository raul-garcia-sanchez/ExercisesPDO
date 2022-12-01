<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita5</title>
    <style>
		body {}

		table,
		td,th {
			border: 1px solid black;
			border-spacing: 0px;
		}
	</style>
</head>

<body>
    <h1>FIltratge de llengues</h1>

    <?php

    try {
        $hostname = "127.0.0.1";
        $dbname = "world";
        $username = "admin";
        $pw = "admin123";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    ?>

    <form action="" method="POST">
        <label for="llengua">Escull una llengua:</label>
        <input type="text" name="llengua">
        <input type="submit" name="submit" id="">
    </form>


    

        <?php

        if(isset($_POST["submit"])){
            $query2 = $pdo->prepare("select c.Name as Name, l.language as language, l.IsOfficial as oficial, l.Percentage as percentatge from countrylanguage l inner join country c 
    on l.CountryCode = c.Code where Name like '%" . $_POST['llengua'] . "%';");
     $query2->execute();
     $row = $query2->fetch();
     ?>

<table>

<thead>
    <td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td>
</thead>
<tr>
    <th>Name</th>
    <th>Llengua</th>
    <th>ES oficial</th>
    <th>Percentatge</th>
</tr>

<?php

     while ($row) {
         echo "\t<tr>\n";
         echo "\t\t<td>" . $row["Name"] . "</td>\n";
         echo "\t\t<td>" . $row['language'] . "</td>\n";
         echo "\t\t<td>" . $row['oficial'] . "</td>\n";
         echo "\t\t<td>" . $row['percentatge'] . "</td>\n";
         echo "\t</tr>\n";
         $row = $query2->fetch();
     }
        }

     
     ?>

    </table>
</body>

</html>