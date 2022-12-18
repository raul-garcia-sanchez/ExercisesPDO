<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <title>Editar usuaris</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            border-spacing: 0px;
        }
    </style>
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

    $query2 = $pdo->prepare("select * from users");
    $query2->execute();
    $row = $query2->fetch();

    ?>

    <div id="dialog" title="Edit user">
    <form action="" method="post">
            <input type="text" name='id' hidden>
            <label for="username">Nom d'usuari:</label><br>
            <input type="text" name="username"><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email"><br>
            <label for="role">Role:</label><br>
            <input type="text" name="role">
            <input class="send" type="submit" name="submitDialog">
        </form>
    </div>

    <table>

        <thead>
            <td colspan="6" align="center" bgcolor="cyan">Users list</td>
        </thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="2">Functions</th>
        </tr>

            
            <?php
            while ($row) {
                echo "\t<tr>\n";
                echo "\t\t<td>".$row['id']."</td>\n";
                echo "\t\t<td>".$row['username'] . "</td>\n";
                echo "\t\t<td>".$row['email'] . "</td>\n";
                echo "\t\t<td>" . $row['role'] . "</td>\n";
                echo "\t\t<td> <button name='buttonDialog' value='".$row['id'].",".$row['username'].",".$row['email'].",".$row['role']."'>Edit</button> </td>\n";
                echo "\t\t<td> <button  name='deleteUser' value='".$row['id']."' >Delete</button> </td>\n";
                echo "\t</tr>\n";
                $row = $query2->fetch();
            }
            ?>
    </table>

    

    <script>

    
    $("#dialog").dialog({
    autoOpen: false,
    modal: true
    });

    $("[name='buttonDialog']").click(function (event) {
        var informationUser = event.target.value.split(",");
        console.log(informationUser);
        $("[name='id']").val(informationUser[0]);
        $("[name='username']").val(informationUser[1]);
        $("[name='email']").val(informationUser[2]);
        $("[name='role']").val(informationUser[3]);
        $("#dialog").dialog("open");
    })

    
    $("[name='deleteUser']").click(function (event) {
        window.location.href = window.location.href + "?id=" + event.target.value;
        console.log(event.target.value);
    })
    

    </script>

    <?php

    if (isset($_POST["submitDialog"])) {
        try {
            $password = hash('sha256', $_POST['contrasenya']);
            $query2 = $pdo->prepare("update users set username = ?, password = ?, email = ?, role = ? where id = ?;");
            $query2->bindParam(1, $_POST['username']);
            $query2->bindParam(2, $password);
            $query2->bindParam(3, $_POST['email']);
            $query2->bindParam(4, $_POST['role']);
            $query2->bindParam(5, $_POST['id']);
            $query2->execute();
            header("Location: admin_user.php");
            echo "<p><strong>Usuario editado correctamente</strong></p>";
        } catch (error $e) {
            echo "<p align='center'><strong>Usuario no editado</strong></p>";
        }
    }

    if(isset($_GET['id'])){
        try {
            $query3 = $pdo->prepare("delete from users where id = ?;");
            $query3->bindParam(1, $_GET['id']);
            $query3->execute();
            header("Location: admin_user.php");
            echo "<p><strong>Usuario eliminado correctamente</strong></p>";
        } catch (error $e) {
            echo "<p><strong>Usuario no eliminado</strong></p>";
        }
    }


    ?>


</body>

</html>