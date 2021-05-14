<?php
session_start();
include "../inc/header.php";
include "../inc/owner_navbar.php";



$stmt=$con->prepare("SELECT confirm FROM stores WHERE store_owner=:store_owner");
$stmt->execute(array('store_owner' => $_SESSION["u_name"]));
$storname = $stmt->fetch();
$confirm_store = $storname["confirm"];

if($confirm_store == 0){
    header("Location: lock.php");
}


echo "<h2>اهلاً ". $_SESSION["full_name"]."</h2>";
echo "<hr>";
echo "<p>الصفحة تحت التطوير</p>";
include "../inc/footer.php";

?>

