<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>

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

<h1>Hola <?php echo $_SESSION['user']?></h1><br>
<a href="logout.php">Clica per sortir de la sessió</a><br>
<a href="profile.php">Clica per editar el teu perfil</a><br>

<?php

$query2 = $pdo->prepare("select role from users where username = ?");
$query2->bindParam(1, $_SESSION['user']);
$query2->execute();
$row = $query2->fetch();

if($row[0] == 'admin'){
    echo "<a href='admin_user.php'>Clica per editar usuaris</a>";
}

?>
    
</body>
</html>