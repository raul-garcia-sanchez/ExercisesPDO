<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita1 PHP</title>
</head>

<body>
    <h1>Desplegable continents</h1>

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

    $query = $pdo->prepare('select distinct continent from country;');
    $query->execute();

    ?>

    <form action="" method="POST">
        <label for="codi_pais">Choose a continent:</label>
        <select name="codi_pais" id="codi_pais">

            <?php

            $row = $query->fetch();

            while ($row) {
                echo "<option value=" . $row["continent"] . ">" . $row["continent"] . "</option>";
                $row = $query->fetch();
            }

            unset($query);
            ?>

        </select>
        <input type="submit" name="" id="">
    </form>


    <?php

        $query2 = $pdo->prepare("select name from country where Continent = '".$_POST["codi_pais"]."';");
        $query2->execute();
        $row = $query2->fetch();

        echo "<ul>";

        while ($row) {
            echo "<li>".$row["name"]."</li>";
            $row = $query2->fetch();
        }
        echo "</ul>";

        unset($query2);
        unset($pdo);
    ?>


</body>

</html>