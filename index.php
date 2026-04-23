<?php
require 'db.php';

if (!isset($_SESSION['uid'])) {
    die("Zaloguj się <a href='login.php'>Login</a>");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>System rezerwacji</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Dostępne terminy</h2>

    <?php
    $r = mysqli_query($conn, "SELECT * FROM slots WHERE dostepny=1");

    while ($s = mysqli_fetch_assoc($r)) {
        echo "<div class='card'>";
        echo "<span>{$s['data']} {$s['godzina']}</span>";
        echo "<a class='btn' href='reserve.php?id={$s['id']}'>Rezerwuj</a>";
        echo "</div>";
    }
    ?>

    <div class="nav">
        <a href="my_reservations.php">Moje rezerwacje</a>
        <a href="logout.php">Logout</a>
    </div>


<?php
$q = mysqli_query($conn, "SELECT is_admin FROM users WHERE id=".$_SESSION['uid']);
$u = mysqli_fetch_assoc($q);

if($u['is_admin']==1) {
    echo "<br><a href='admin.php'>Panel admina</a>";
}
?>

</div>

</body>
</html>