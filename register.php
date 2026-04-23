<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = htmlspecialchars($_POST['login']);
    $email = htmlspecialchars($_POST['email']);
    $pass = $_POST['pass'];

    if (!preg_match('/^(?=.*\d).{14,}$/', $pass)) {
        die("Hasło musi mieć min. 14 znaków i cyfrę");
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $q = mysqli_prepare($conn, "INSERT INTO users(login, password, email) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($q, "sss", $login, $hash, $email);
    mysqli_stmt_execute($q);

    echo "Zarejestrowano!<br>";
    echo "<a href='login.php'>Zaloguj się</a>";

}
?>

<form method="POST">
    Login: <input name="login"><br>
    Email: <input name="email"><br>
    Hasło: <input type="password" name="pass"><br>
    <button>Rejestracja</button>
</form>
</div>
</body>
</html>