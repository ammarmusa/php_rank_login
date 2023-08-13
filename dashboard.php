<?php
session_start();
?>

<?php
include "access.php";
access('ADMIN');
include "header.php";
?>

<h1>Dashboard</h1>
<?php include "footer.php"; ?>