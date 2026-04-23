<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $q = mysqli_prepare($conn, "SELECT id, password FROM users WHERE login=?");
    mysqli_stmt_bind_param($q, "s", $login);
    mysqli_stmt_execute($q);

    mysqli_stmt_bind_result($q, $id, $hash);
    mysqli_stmt_fetch($q);

    if ($id !== null && $hash !== null && password_verify($pass, $hash)) {
        $_SESSION['uid'] = $id;
        header("Location: index.php");
        exit;
    }

    echo "Błędny login lub hasło!";
}
?>

<form method="POST">
    Login: <input name="login"><br>
    Hasło: <input type="password" name="pass"><br>
    <button>Login</button>
</form>
<a href="register.php">Nie masz konta? Zarestruj się</a>
</div>
</body>
</html>