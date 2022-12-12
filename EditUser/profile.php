<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        h1 {
            text-align: center;
        }

        label {
            font-size: 18px;
        }

        input {
            border-radius: 5px;
            width: 40%;
            height: 30px;
            margin-top: 10px;
        }

        .send {
            background-color: #33afff;
            width: 50%;
            height: 40px;
            margin-top: 20px;
        }

        form {
            text-align: center;
            border: 1px solid black;
            width: 50%;
            margin: auto;
            border-radius: 30px;
            height: 400px;
            padding-top: 5%;
        }

        
    </style>
</head>

<body>

    <h1>Editar perfil de
        <?php echo $_SESSION['user'] ?>
    </h1>

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
        <label for="email">Email:</label><br>
        <input type="email" name="email"><br>
        <label for="password">Contrasenya:</label><br>
        <input type="password" name="contrasenya"><br>
        <label for="password2">Confirmar contrasenya:</label><br>
        <input type="password" name="contrasenya2"><br>
        <input class="send" type="submit" name="submit">

    </form>

    <?php

    if (isset($_POST["submit"])) {
        if ($_POST["contrasenya"] != $_POST["contrasenya2"]) {
            echo "<p align='center'><strong>Contraseñas no coinciden</strong></p>";
            die();
        }
        try {
            $password = hash('sha256', $_POST['contrasenya']);
            $query2 = $pdo->prepare("update users set username = ?, password = ?, email = ? where username = ?;");
            $query2->bindParam(1, $_POST['username']);
            $query2->bindParam(2, $password);
            $query2->bindParam(3, $_POST['email']);
            $query2->bindParam(4, $_SESSION['user']);
            $query2->execute();
            echo "<p align='center'><strong>Usuario editado correctamente</strong></p>";
            echo "<p align='center'><a href='login.php'>Anar al login</a></p>";
        } catch (error $e) {
            echo "<p align='center'><strong>Usuario no editado</strong></p>";
        }
    }

    ?>

</body>

</html>