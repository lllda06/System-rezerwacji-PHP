<?php
$conn = mysqli_connect('localhost', 'root', '', 'reserwacja');
if(!$conn) die('Wystąpił błąd podczas połączenia z BD!');

session_start();
?>