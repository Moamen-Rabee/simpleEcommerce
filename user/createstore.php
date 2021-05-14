<?php
session_start();
include "../inc/header.php";
include "../inc/navbar.php";
include "../connect.php";

if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "user"){
  header("Location: ../index.php");
}

if(!isset($_GET["do"])){ // do not found set add
  $do = "form";
}else{
  $do = $_GET["do"];
}


if($do == "form"){
?>
        <!-- header -->
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
        <!-- end header -->
        <!--add store box-->

        <div class="container">
          <div class="mybox ">
            <h3>انشاء متجر الكترونى</h3>
            <hr>
            <div class="row">
              <div class="offset-lg-2 col-lg-8">
                <form method="post" action="?do=addstore">
                  <div class="form-group" style="text-align: right;">
                      <label for="storename">الاسم <span style="color:red;">*</span></label>
                      <input type="text" name="storename" id="storename" class="form-control" placeholder="اسم المتجر الالكترونى" required="required" aria-describedby="helpId">
                  </div>

                  <div class="form-group" style="text-align: right;">
                      <label for="address">العنوان <span style="color:red;">*</span></label>
                      <input type="text" name="address" id="address" class="form-control" placeholder="عنوان المتجر الالكترونى" required="required" aria-describedby="helpId">
                  </div>

                  <div class="form-group" style="text-align: right;">
                      <label for="phone">رقم الهاتف <span style="color:red;">*</span></label>
                      <input type="text" name="phone" id="phone" class="form-control" placeholder="رقم الهاتف للمتجر" required="required" aria-describedby="helpId">
                  </div>

                  <div class="form-group" style="text-align: right;">
                      <label for="location">البلد <span style="color:red;">*</span></label>
                      <input type="text" name="location" id="location" class="form-control" placeholder="البلد" required="required" aria-describedby="helpId">
                  </div>

                  <div class="form-group" style="text-align: right;">
                      <label for="facebook">فيسبوك <span style="color:red;">*</span></label>
                      <input type="text" name="facebook" id="facebook" class="form-control" placeholder="رابط الصفحة" aria-describedby="helpId">
                  </div>

                  <div class="form-group" style="text-align: right;">
                      <label for="email">بريد الكترونى <span style="color:red;">*</span></label>
                      <input type="text" name="email" id="email" class="form-control" placeholder="البريد الالكترونى للمتجر" aria-describedby="helpId">
                  </div>
<?php
$stmt=$con->prepare("SELECT * FROM categorys");
$stmt->execute();
$rows = $stmt->fetchAll();
?>
                  <div class="form-group" style="text-align: right;">
                    <label for="category">نوع السلعة المباعة <span style="color:red;">*</span></label>
                    <select class="form-control" name="category" id="category" style="padding: 0;">
                    <?php
                      foreach($rows as $row){
                        // echo $row['category_name'];
                        echo '<option>'.$row['category_name'].'</option>';
                      }
                    ?>
                    </select>
                  </div>


                  <button type="subbmit" class="btn btn-md btn-primary float-right" width="100px"><i class="fa fa-save"></i>طلب انشاء المتجر</button>
                </form>
              </div>
            </div>
        </div>
          
      </div>
    <!--end add store box-->
        


<?php
}elseif($do == "addstore"){
  
  $storename  = $_POST['storename'];
  $owner      = $_SESSION["u_name"];
  $address    = $_POST['address'];
  $phone      = $_POST['phone'];
  $location   = $_POST['location'];
  $facebook   = $_POST['facebook'];
  $email      = $_POST['email'];
  $category   = $_POST['category'];


  $stmt = $con->prepare("INSERT INTO stores (store_name,store_owner,store_adderss,store_phone,store_country,store_facebook,store_email,store_category,confirm) 
  VALUES (:store_name,:store_owner,:store_adderss,:store_phone,:store_country,:store_facebook,:store_email,:store_category,:confirm)");

  $stmt->execute(array(
    'store_name'          => $storename,
    'store_owner'         => $owner,
    'store_adderss'       => $address,
    'store_phone'         => $phone,
    'store_country'       => $location,
    'store_facebook'      => $facebook,
    'store_email'         => $email,
    'store_category'      => $category,
    'confirm'             => 0
  ));


  $stmt = $con->prepare("UPDATE users SET type = 'owner' WHERE u_name = :u_name");

  $stmt->execute(array(
    'u_name' => $_SESSION["u_name"]
  ));

  $_SESSION["store_name"] = $storename;
  
  header("Location: ../owner/index.php");
  
  
  


}




include "../inc/footer.php";
?>