<?php
session_start();
include "../inc/header.php";
include "../inc/navbar.php";


if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "user"){
  header("Location: ../index.php");
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
        <!--search box-->
        <div class="container">
          <div class="mybox">
            <h3>البحث فى المنتجات</h3>
            <center>
              <form method="get" action="view_products.php">
                <input class="form-control form-control-lg" name="search_word" type="text" placeholder="اسم المنتج">
                <button type="submit" class="btn btn-lg btn-outline-info" width="100px">بحث</button>
              </form>
            </center>
          </div>
          <div style="padding: 0px 50px 50px 50px; text-align: center;">
            <a href="createstore.php">انشاء متجر الكترونى مجاناً</a><br>
          </div>
          
        </div>
        <!--end search box-->
        
        
        <footer>
          <p>PentaCoders Team &copy;</p>
        </footer>

<?php
include "../inc/footer.php";
?>