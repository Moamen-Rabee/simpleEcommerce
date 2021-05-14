<?php
session_start();
include "../inc/header.php";
include "../connect.php";
include "../inc/navbar.php";


if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "user"){
    header("Location: ../index.php");
}

if(!isset($_GET["id_product"]) or $_GET["id_product"] == ""){
    header("Location: userHome.php");
  }

?>
<div class="container">
    <div class="row">
        <?php
            $id = addslashes($_GET['id_product']);
            $stmt=$con->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute(array($id));
            $result = $stmt->fetchAll();
            $count = $stmt->rowCount();
                

                
            if($count > 0){
                
                foreach($result as $product){
                    ?>
                        <div class="col-md-6">
                            <br>
                            <div class="card text-left">
                                <img class="card-img-top" style="height: 537px;" src="../owner/uplouds/product_images/<?php echo $product['product_img']; ?>" alt="">
                                <div class="card-body">
                                    <h4 class="card-title" style="color: #46a741; text-align: center;"><?php echo $product['product_name']; ?></h4>
                                    <p class="card-text" style="font-weight: bold;text-align: center;background: #46a741;padding: 6px;color: #fff;">السعر : <?php echo $product['product_sale_price']; ?></p>
                                        <form method="post" action="add_cart.php">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>"/>
                                            <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>"/>
                                            <input type="hidden" name="store_name" value="<?php echo $product['product_store_name']; ?>"/>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                <label for="product_qty">الكمية<span style="color:#F00;">*</span></label>
                                                <input type="text" name="product_qty" class="form-control" id="product_qty" placeholder="الكمية المطلوبة من المنتج" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                <label for="phone">رقم الهاتف<span style="color:#F00;">*</span></label>
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="رقم الهاتف" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                <label for="address">العنوان<span style="color:#F00;">*</span></label>
                                                <input type="text" name="address" class="form-control" id="address" placeholder="عنوان وصول المنتج" required>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary btn-block mb-2"><i class="fas fa-shopping-cart"></i>اضافة الى المشتريات</button>
                                        </form>
                                    
                                    
                                    
                                    <div style="font-size: 12px; color: #888; text-align: center;">
                                        <i class="fas fa-home"></i><?php echo $product['product_store_name']; ?>
                                        | </i><?php echo $product['product_date']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }
            else{
                ?>
                <div class="col-md-12"><br>
                <div class='alert alert-danger text-center' width='100%'>عفواً يرجى التأكد من المنتج المراد البحث عنه او ازالة اى علامات</div>
                </div>
                <?php
            }
            ?>
        
    </div>
</div>


<?php
include "../inc/footer.php";
?>