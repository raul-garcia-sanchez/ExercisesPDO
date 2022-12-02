<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        h1 {
            text-align: center;
        }
        label{
            font-size: 18px;
        }
        input{
            border-radius: 5px;
            width: 40%;
            height: 30px;
            margin-top: 10px;
        }
        .send{
            background-color: #33afff;
            width: 50%;
            height: 40px;
            margin-top: 20px;
        }

        form{
            text-align: center;
            border: 1px solid black;
            width: 50%;
            margin: auto;
            border-radius: 30px;
            height: 300px;
            padding-top: 5%;
        }
    </style>
</head>

<body>

    <h1>Register</h1>

    <?php

    try {
        $hostname = "127.0.0.1";
        $dbname = "users_aws2";
        $username = "admin";
        $pw = "admin123";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    ?>


    <form action="" method="post">
        <label for="username">Nom d'usuari:</label><br>
        <input type="text" name="username"><br>
        <label for="password">Contrasenya:</label><br>
        <input type="password" name="contrasenya"><br>
        <input class="send" type="submit" name="submit">
    </form>





    <?php

    if (isset($_POST["submit"])) {
        //$password = hash('sha256', $_POST['contrasenya']);
        try {
            $query2 = $pdo->prepare("INSERT INTO users (username,password) VALUES ('" . $_POST["username"] . "', sha2('" . $_POST["contrasenya"] . "','256'));");
            $query2->execute();
            echo "<p align='center'><strong>Usuario insertado correctamente</strong></p>";
        } catch (error $e) {
            echo "<p align='center'><strong>Usuario no insertado</strong></p>";
        }
    }

    ?>

</body>

</html>