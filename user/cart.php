<?php

use function PHPSTORM_META\type;

session_start();
include "../inc/header.php";
include "../connect.php";
include "../inc/navbar.php";


if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "user"){
    header("Location: ../index.php");
}


if(isset($_GET["do"])){
	$do = filter_var($_GET["do"], FILTER_SANITIZE_STRING);
}else{
	$do = "view";
}

if($do == "view"){
    $stmt=$con->prepare("SELECT * FROM cart WHERE user_name=:user_name and done=0 and confirm=0");
	$stmt->execute(array(
        'user_name' => $_SESSION['u_name']
    ));
    $rows = $stmt->fetchAll();
    $rowsCount = $stmt->rowCount();

    if($rowsCount > 0){
        ?>
    
            <div class="container">
                <div class="mybox">
                    <h3>التأكيد على طلبك</h3><hr/>
                    <div class="table-responsive">
                        <table class="table table-hover table table-sm">
                            <thead>
                                <tr class="table-primary">
                                
                                <th scope="col">اسم المنتح</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">المتجر</th>
                                <th scope="col" class="text-center">التأكيد</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($rows as $row){
                                        ?>
                                            <tr>
                                                
                                                <td><?php echo $row["product_name"]; ?></td>
                                                <td><?php echo $row["product_amount"]; ?></td>
                                                <td><?php echo $row["store_name"]; ?></td>
                                                
                                                <td class="text-center">
                                                    <a href="cart.php?do=delete&id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> حذف</a>
                                                    <a href="cart.php?do=done&id=<?php echo $row["id"]; ?>&product_id=<?php echo $row["product_id"]; ?>&qty=<?php echo $row["product_amount"]; ?>" class="btn btn-sm btn-primary"> التاكيد</a>
                                                </td>
                                                
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php
    }else{
        ?>
        <div class="container">
            <div class="mybox">
                <h3>التأكيد على طلبك</h3><hr/>
                <div class="alert alert-danger" role="alert">
                    <strong>عفواً يرجى اضافة منتجات للعربة أولاً</strong>
                </div>
            </div>
        </div>
        <?php
    }
    

}elseif($do == "done"){
    //done code

    if(isset($_GET["id"])){
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

        $stmt = $con->prepare("UPDATE cart set done=1 WHERE id=$id");

        $stmt->execute();



        $qty = filter_var($_GET["qty"], FILTER_SANITIZE_NUMBER_INT);
        $id_p = $_GET["product_id"];
        // $stmt = $con->prepare("UPDATE products set product_qty=product_qty-:qty WHERE id=$id");
        $stmt = $con->prepare("UPDATE `products` SET `product_qty` = `product_qty` - $qty WHERE `products`.`id` = ?;");
        
        $stmt->execute(array($id_p));


    }

    header("Location: cart.php");



}elseif($do == "delete"){
    // delete code

    if(isset($_GET["id"])){
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        
        $stmt = $con->prepare("DELETE FROM cart WHERE id=$id and user_name=:user_name ");

        $stmt->execute(array(
            'user_name' => $_SESSION["u_name"]
        ));

    }

    header("Location: cart.php");


}


include "../inc/footer.php";
?>