<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje rezerwacje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="index.php">Wróć</a>
        <?php
require 'db.php';

if (!isset($_SESSION['uid'])) die("Login required");

$user_id = $_SESSION['uid'];

$q = mysqli_prepare($conn, "
SELECT r.id, s.data, s.godzina, r.slot_id
FROM reservations r
JOIN slots s ON r.slot_id = s.id
WHERE r.user_id=?
");

mysqli_stmt_bind_param($q, "i", $user_id);
mysqli_stmt_execute($q);
$result = mysqli_stmt_get_result($q);

echo "<h2>Moje rezerwacje</h2>";

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['data'] . " " . $row['godzina'];
    echo " <a href='cancel.php?id={$row['id']}&slot={$row['slot_id']}'>Anuluj</a><br>";
}
?>
    </div>
</body>
</html>