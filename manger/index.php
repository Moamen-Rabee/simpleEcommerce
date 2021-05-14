<?php
session_start();
include "../inc/header.php";
include "../inc/manger_navbar.php";
include "../connect.php";
if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "manger"){
    header("Location: ../index.php");
}


$stmt = $con->prepare("SELECT * FROM stores WHERE confirm=1");
$stmt->execute();
$stores_conf = $stmt->fetch();
$stores_conf = $stmt->rowCount();


$stmt = $con->prepare("SELECT * FROM stores WHERE confirm=0");
$stmt->execute();
$stores_notconf = $stmt->fetch();
$stores_notconf = $stmt->rowCount();

$stmt = $con->prepare("SELECT * FROM cart WHERE confirm=1 and done=1");
$stmt->execute();
$cart = $stmt->fetch();
$cart = $stmt->rowCount();

$stmt = $con->prepare("SELECT * FROM users WHERE type='user'");
$stmt->execute();
$users = $stmt->fetch();
$users = $stmt->rowCount();


?>
<div class="container">
<h1 class="headding">لوحة التحكم</h1><hr>
    <div class="row">
    
        <div class="col-lg-6 col-md-12">
            <a href="#" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#2980b9;">
                <h4>المتاجر المفعلة</h4>
                <h2><?php echo $stores_conf; ?></h2>
            <div class="logo_section"><i class="fa fa-home"></i></div>
            </div>
            </a>
        </div>


        <div class="col-lg-6 col-md-12">
            <a href="#" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#e74c3c;">
                <h4>المتاجر المعلقة</h4>
                <h2><?php echo $stores_notconf; ?></h2>
            <div class="logo_section"><i class="fa fa-house-damage"></i></div>
            </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12">
            <a href="#" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#27ae60;">
                <h4>عدد المبيعات</h4>
                <h2><?php echo $cart; ?></h2>
            <div class="logo_section"><i class="fa fa-shopping-cart"></i></div>
            </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12">
            <a href="#" style="color:#fff; text-decoration:none;">
            <div class="dashboard_section" style="background-color:#f1c40f;">
                <h4>عدد المستخدمين</h4>
                <h2><?php echo $users; ?></h2>
            <div class="logo_section"><i class="fa fa-users"></i></div>
            </div>
            </a>
        </div>

    </div>

    
</div>
<?php
include "../inc/footer.php";
?>
