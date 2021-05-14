<?php
session_start();
include "../inc/header.php";
include "../inc/owner_navbar.php";
include "../connect.php";
if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "owner"){
    header("Location: ../index.php");
}

$stmt=$con->prepare("SELECT confirm FROM stores WHERE store_owner=:store_owner");
$stmt->execute(array('store_owner' => $_SESSION["u_name"]));
$storname = $stmt->fetch();
$confirm_store = $storname["confirm"];

if($confirm_store == 0){
    header("Location: lock.php");
}


$stmt = $con->prepare("SELECT * FROM supplier WHERE supplier_store_name=?");
$stmt->execute(array($_SESSION['store_name']));
$suppliers = $stmt->fetch();
$suppliers = $stmt->rowCount();


$stmt = $con->prepare("SELECT * FROM products WHERE product_store_name=?");
$stmt->execute(array($_SESSION['store_name']));
$products = $stmt->fetch();
$products = $stmt->rowCount();


$stmt=$con->prepare("SELECT * FROM `cart` WHERE done=1 AND confirm=0 AND store_name=?");
$stmt->execute(array($_SESSION['store_name']));
$orders = $stmt->fetchAll();
$orders = $stmt->rowCount();

$stmt=$con->prepare("SELECT * FROM `cart` WHERE done=1 AND confirm=1 AND store_name=?");
$stmt->execute(array($_SESSION['store_name']));
$orders_done = $stmt->fetchAll();
$orders_done = $stmt->rowCount();



?>
<div class="container">
<h1 class="headding">لوحة التحكم</h1><hr>
    <div class="row">
    
        <div class="col-lg-6 col-md-12">
            <a href="supplier.php" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#2980b9;">
                <h4>الموردين</h4>
                <h2><?php echo $suppliers; ?></h2>
            <div class="logo_section"><i class="fa fa-users"></i></div>
            </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12">
            <a href="products.php" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#e67e22;">
                <h4>المنتجات</h4>
                <h2><?php echo $products; ?></h2>
            <div class="logo_section"><i class="fab fa-product-hunt"></i></div>
            </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12">
            <a href="orders.php" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#e74c3c;">
                <h4>الطلبات</h4>
                <h2><?php echo $orders; ?></h2>
            <div class="logo_section"><i class="fa fa-shopping-cart"></i></div>
            </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12">
            <a href="#" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#27ae60;">
                <h4>طلابات تم استلامها</h4>
                <h2><?php echo $orders_done; ?></h2>
            <div class="logo_section"><i class="fa fa-thumbs-up"></i></div>
            </div>
            </a>
        </div>


    </div>

    
</div>
<?php
include "../inc/footer.php";
?>
