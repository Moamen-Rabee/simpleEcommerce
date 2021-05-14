<?php
session_start();
include "connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $u_name     = trim($_POST["u_name"]);
  $pass       = $_POST["password"];

  // echo $u_name;
  // echo $pass;


  $errs = array();
  if(empty($u_name)){
    $errs[] = "عفواً ، اسم المستخدم فارغ";
  }
  if(strlen($u_name) < 4){
    $errs[] = "عفواً ، الحد الأدنى لأسم المستخدم 4 أحرف";
  }
  if(empty($pass)){
    $errs[] = "عفواً ، كلمة المرور فارغة";
  }
  if(strlen($pass) < 4){
    $errs[] = "عفواً ، الحد الأدنى لكلمة المرور 4 أحرف";
  }

  if(empty($errs)){
    $stmt = $con->prepare("SELECT * FROM users WHERE u_name = ? AND password = ?");
    $stmt->execute(array($u_name,sha1($pass)));

    if($stmt->rowCount() > 0){
    $_SESSION['u_name'] = $u_name;
    $r = $stmt->fetch();
    $_SESSION['full_name'] = $r['full_name'];
    $_SESSION['type'] = $r['type'];


    if ($_SESSION['type'] == "user"){ // user account
      header("Location: user/userHome.php");

    }elseif($_SESSION['type'] == "owner"){ // owner accopunt

      $stmt=$con->prepare("SELECT store_name FROM stores WHERE store_owner=:store_owner");
      $stmt->execute(array('store_owner'=>$u_name));
      $storname = $stmt->fetch();
      $_SESSION['store_name'] = $storname["store_name"];
      header("Location: owner/index.php");

    }elseif($_SESSION['type'] == "manger"){ // manger account
      header("Location: manger/index.php");
    }

    
    
    }else{
      header("Location: index.php");
    }

  }else{
      foreach ($errs as $err) {
      echo '<center>';
      echo '<div class="alert alert-danger">'.$err.'</div>';
      echo '</center>';
      }

  }
}

?>

  <!DOCTYPE html>
  <html>
      <head>
          <title>خليج مول للتجارة</title>
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="css/bootstrap.min.css" />
          <link rel="stylesheet" href="css/all.min.css" />
          <link rel="stylesheet" href="css/style.css" />
      </head>

    <body id="body" dir="rtl">
      <div class="container">
        <div class="div_form_login">
          <form class="col-lg-6 col-md-7 col-sm-12 frm_login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>تسجيل الدخول</h1>
            <hr>
            <table width="100%">
        
                <tr>
                    <td colspan="2">
                        <div>
                              <label for="u_name">اسم المستخدم</label><span style="color:red;">*</span>
                              <input type="text" class="form-control" name="u_name" id="u_name" placeholder="اسم المستخدم" required="required">
                        </div>
                    </td>
        
                </tr>
        
                <tr>
                    <td colspan="2">
                        <div>
                              <label for="pass">كلمة المرور</label><span style="color:red;">*</span>
                              <input type="password" class="form-control" name="password" id="pass" placeholder="كلمة المرور" required="required">
                        </div>
                    </td>
                </tr>
        
                <tr>
                    <td colspan="2">
                        <button type="submet" class="btn btn-info btn-block"><i class="fas fa-sign-in-alt"></i>تسجيل الدخول</button>
                    </td>
                </tr>
            </table><br>
            
            <div class="text-center">
            <a href="user/add_user.php" >انشاء حساب جديد</a>
            </div>
          </form>
        </div>
      </div>
      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/all.min.js"></script>
      <script src="js/script.js"></script>
  </body>
</html>
