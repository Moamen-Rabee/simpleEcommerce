<?php
session_start();
include "../inc/header.php";
include "../connect.php";
include "../inc/navbar.php";


if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "user"){
    header("Location: ../index.php");
}

// if(!isset($_GET["id_product"]) or $_GET["id_product"] == ""){
//     header("Location: userHome.php");
// }


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_qty = $_POST['product_qty'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $user_name = $_SESSION["u_name"];

    $year = date('Y');
    $day = date('d');
    $manth = date('m');
    $date = $year."-".$manth."-".$day;



    $stmt = $con->prepare("INSERT INTO cart (product_name,product_id,user_name,product_amount,address,phone,date,store_name,done,confirm) VALUES (:product_name,:product_id,:user_name,:product_amount,:address,:phone,:date,:store_name,:done,:confirm)");

    $stmt->execute(array(
        'product_name' => $product_name,
        'product_id' => $product_id,
        'user_name' => $user_name,
        'product_amount' => $product_qty,
        'address' => $address,
        'phone' => $phone,
        'date' => $date,
        'store_name' => $_POST['store_name'],
        'done' => 0,
        'confirm' => 0
    ));


    // $stmt = $con->prepare("UPDATE products set product_qty=product_qty-:product_qty WHERE id=$product_id");

    // $stmt->execute(array(
    //     'product_qty' => $product_qty
    // ));

    header("Location: view_products.php?search_word=$product_name");



}



include "../inc/footer.php";
?>