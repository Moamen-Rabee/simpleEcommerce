<?php
session_start();
include "../inc/header.php";
include "../inc/navbar.php";

echo "<h2>اهلاً ". $_SESSION["full_name"]."</h2>";
echo "<hr>";
echo "<p>الصفحة تحت التطوير</p>";
?>

