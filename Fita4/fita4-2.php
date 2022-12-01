<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita1 PHP</title>
</head>

<body>
    <h1>Checkboxs continents</h1>

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
        <label for="codi_pais">Choose a continent/s:</label>

        <?php

        $row = $query->fetch();
        echo "<br>";
        while ($row) {
            echo "<input type='checkbox' name='nameContinent[]' value='" . $row["continent"] . "'>" . $row["continent"] . "<br>";
            $row = $query->fetch();
        }

        unset($query);
        ?>
        <input type="submit" name="" id="">
    </form>


    <?php
    if(isset($_POST['nameContinent'])) {
        $txtContinent = implode("', '",$_POST['nameContinent']);

        $queryCountry = $pdo->prepare("SELECT * FROM country where Continent in ('".$txtContinent."');");
        $queryCountry->execute();
        $rowCountry = $queryCountry->fetch();
        echo "<ul>";
        while($rowCountry){
            echo "<li>".$rowCountry["Name"]."</li>";
            $rowCountry = $queryCountry->fetch();
        }
        echo "</ul>";
    }

    unset($query2);
    unset($pdo);
    ?>


</body>

</html>