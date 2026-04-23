<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odmowa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <?php
require 'db.php';

if (!isset($_SESSION['uid'])) die("Login required");

$res_id = (int)$_GET['id'];
$slot_id = (int)$_GET['slot'];

$q = mysqli_prepare($conn, "DELETE FROM reservations WHERE id=? AND user_id=?");
mysqli_stmt_bind_param($q, "ii", $res_id, $_SESSION['uid']);
mysqli_stmt_execute($q);

mysqli_query($conn, "UPDATE slots SET dostepny=1 WHERE id=$slot_id");

echo "Anulowano!";
echo "<br><a href='my_reservations.php'>Back</a>";
?>
</div>
</body>
</html>