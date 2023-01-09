<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
</head>

<body>
    <h1>Upload Files</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        Choose an image:
        <br><br>
        <input name="fileInput" id="fileInput" type="file" /><br><br>
        <input type="submit" name="submit" /><br>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $file = $_FILES['fileInput']['name'];
        if (isset($file) && $file != "") {
            $temp = $_FILES['fileInput']['tmp_name'];
            if (move_uploaded_file($temp, 'images/' . $file)) {
                echo '<p><img src="images/' . $file . '"></p>';
            } else {
                echo '<div><b>Error al mostrar la imatge</b></div>';
            }
        }
    }
    ?>
</body>

</html>