<?php include '../classes/Db.class.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="templates/css/style.css">
</head>
<body>
    <h1>Hello there</h1>
    <?php
        $db = new Db();
        $querry = "Select * FROM users";
        $users = $db->execute($querry);
    ?>
    <table>
        <thead>
            <tr>
                <td>username</td>
                <td>Vorname</td>
                <td>Nachname</td>
                <td>Email</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) {?>
                <tr>
                    <td><?php echo $user['user_name']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>