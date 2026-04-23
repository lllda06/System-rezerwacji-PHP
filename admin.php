<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel admina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        require 'db.php';
        if(!isset($_SESSION['uid'])) die("Zaloguj się");
        $q = mysqli_prepare($conn, "SELECT is_admin FROM users WHERE id=?");
        mysqli_stmt_bind_param($q, "i", $_SESSION['uid']);
        mysqli_stmt_execute($q);
        $r = mysqli_stmt_get_result($q);
        $u = mysqli_fetch_assoc($r);

        if($u['is_admin']!=1) die("Brak dostępu!");

        if($_POST) {
            $data = $_POST['data'];
            $godzina = $_POST['godzina'];

            $q = mysqli_prepare($conn, "INSERT INTO slots(data, godzina, dostepny) VALUES(?,?,1)");
            mysqli_stmt_bind_param($q, "ss", $data, $godzina);
            mysqli_stmt_execute($q);

            echo "Dodano termin!";
        }
        ?>
        <form method="POST">
            Data: <input type="date" name="data"><br>
            Godzina: <input type="time" name="godzina"><br>
            <button>Dodaj</button>
        </form>
        <br><a href="index.php">Powrót</a>
    </div>
</body>
</html>