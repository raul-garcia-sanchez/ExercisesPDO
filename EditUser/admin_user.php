<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <table>

        <thead>
            <td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td>
        </thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
        </tr>

        <form action="" method="POST">
            <?php
            $count = 1;
            while ($row) {
                echo "\t<tr>\n";
                echo "\t\t<td><input type='text' name='id" . $count . "' value=" . $row['id'] . "></td>\n";
                echo "\t\t<td><input type='text' name='username" . $count . "' value=" . $row['username'] . "></td>\n";
                echo "\t\t<td><input type='email' name='email" . $count . "' value=" . $row['email'] . "></td>\n";
                echo "\t\t<td><input type='text' name='role" . $count . "' value=" . $row['role'] . "></td>\n";
                echo "\t</tr>\n";
                $row = $query2->fetch();
                $count++;
            }
            ?>
    </table>
    <input type="submit" name="submit">

    </form>

    <?php

        //falta hacer los updates de todos

        for($i = $count; $i < 1; $i--){
            $query2 = $pdo->prepare("update users set username = ?, email = ? where id = ?;");
            $query2->bindParam(1, $_POST['username'.$count]);
            $query2->bindParam(2, $_POST['email'.$count]);
            $query2->bindParam(3, $_POST['id'.$count]);//falta esto
            $query2->execute();
        }



    ?>


</body>

</html>