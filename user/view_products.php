<?php
session_start();
include "../inc/header.php";
include "../connect.php";
include "../inc/navbar.php";


if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "user"){
    header("Location: ../index.php");
}

if(!isset($_GET["search_word"]) or $_GET["search_word"] == ""){
  header("Location: userHome.php");
}

?>

        <!--header-->
        <header>
          <div class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="text_header">
                    <h1>خليج مول للتجارة</h1><br>
                    <h3>بيع و شراء كل شيئ تتخيله</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>
        <!--end header-->
<div class="container">
    <div class="lable_search_word">
        <h3>لقد قومت بالبحث عن : <?php echo $_GET['search_word']; ?></h3> 
    </div>
    <div class="row">
        <?php
            $search_word = addslashes($_GET['search_word']);
            $stmt=$con->prepare("SELECT * FROM products WHERE product_name LIKE '%$search_word%'");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $count = $stmt->rowCount();
                

                
            if($count > 0){
                
                foreach($result as $product){
                    ?>
                        <div class="col-md-3">
                            <div class="card text-left">
                                <img class="card-img-top" style="height: 253px;" src="../owner/uplouds/product_images/<?php echo $product['product_img']; ?>" alt="">
                                <div class="card-body">
                                  <h4 class="card-title" style="color: #46a741; text-align: center;"><?php echo $product['product_name']; ?></h4>
                                  <p class="card-text" style="font-weight: bold;text-align: center;background: #46a741;padding: 6px;color: #fff;">السعر : <?php echo $product['product_sale_price']; ?></p>
                                  
                                  <a href="view_one_product.php?id_product=<?php echo $product['id']; ?>" class="btn btn-primary btn-block mb-2"><i class="fas fa-shopping-cart"></i>اضافة الى المشتريات</a>
                                  
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


<br>
        <footer>
            <p>PentaCoders Team &copy;</p>
        </footer>

<?php
include "../inc/footer.php";
?>