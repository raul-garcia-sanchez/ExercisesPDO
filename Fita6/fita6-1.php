<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fita6</title>
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
    <h1>Insertar nova llengua</h1>

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

    $query = $pdo->prepare("SELECT * from country;");
    $query->execute();
    $row = $query->fetch();
    
    ?>

    <form action="" method="POST">
        <select name='addLanguage' id='addLanguage'>
            <?php
            while($row){
                echo "<option value='".$row['Code']."'> ".$row['Name']."</option>";
                $row = $query->fetch();
            }
            ?>
        </select><br><br>
        <label for="">Nom de la llengua:</label>
        <input type="text" name="nameLanguage"><br><br>
        <label for="">Llengua oficial:</label>
        <input type="radio" name="official" value="T">
        <label for="">Oficial</label>
        <input type="radio" name="official" value="F">
        <label for="">No oficial</label><br><br>
        <label for="">Població:</label>
        <input name="percentatge" type="number"><br><br>
        <input name="submit" type="submit">
    </form>

        <?php

        if(isset($_POST["submit"])){
            $query = $pdo->prepare("INSERT INTO countrylanguage (CountryCode, Language, IsOfficial, Percentage) VALUES (:code, :language, :oficial, :percentatge)");
            $query->bindParam(':code', $_POST['addLanguage']);
            $query->bindParam(':language', $_POST['nameLanguage']);
            $query->bindParam(':oficial', $_POST['official']);
            $query->bindParam(':percentatge', $_POST['percentatge']);

     $query->execute();

        }

     
     ?>

</body>

</html>