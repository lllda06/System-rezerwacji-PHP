<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerwacja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="index.php">Wróć</a><br><br>
        <?php
require 'db.php';

if (!isset($_SESSION['uid'])) {
    die("Zaloguj się");
}

$user_id = $_SESSION['uid'];
$slot_id = (int)$_GET['id'];

$q = mysqli_prepare($conn, "SELECT COUNT(*) FROM reservations WHERE user_id=?");
mysqli_stmt_bind_param($q, "i", $user_id);
mysqli_stmt_execute($q);
mysqli_stmt_bind_result($q, $count);
mysqli_stmt_fetch($q);
mysqli_stmt_close($q);

if ($count >= 3) {
    die("Limit 3 rezerwacji!");
}

$q = mysqli_prepare($conn, "SELECT id FROM reservations WHERE user_id=? AND slot_id=?");
mysqli_stmt_bind_param($q, "ii", $user_id, $slot_id);
mysqli_stmt_execute($q);

mysqli_stmt_store_result($q);

if (mysqli_stmt_num_rows($q) > 0) {
    mysqli_stmt_close($q);
    die("Już zarezerwowane!");
}

mysqli_stmt_close($q);

$q = mysqli_prepare($conn, "SELECT dostepny FROM slots WHERE id=?");
mysqli_stmt_bind_param($q, "i", $slot_id);
mysqli_stmt_execute($q);
mysqli_stmt_bind_result($q, $available);
mysqli_stmt_fetch($q);
mysqli_stmt_close($q);

if ($available == 0) {
    die("Termin zajęty!");
}

$q = mysqli_prepare($conn, "INSERT INTO reservations(user_id, slot_id) VALUES (?, ?)");
mysqli_stmt_bind_param($q, "ii", $user_id, $slot_id);
mysqli_stmt_execute($q);
mysqli_stmt_close($q);

mysqli_query($conn, "UPDATE slots SET dostepny=0 WHERE id=$slot_id");

echo "Zarezerwowano!";
echo "<br><a href='index.php'>Powrót</a>";
?>

    </div>
</body>
</html>