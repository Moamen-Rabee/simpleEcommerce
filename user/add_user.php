<?php
session_start();
include "../inc/header.php";
include "../connect.php";

if(isset($_SESSION["u_name"]) and $_SESSION["type"] = "user"){
  header("Location: ../index.php");
}

if(!isset($_GET["do"])){ // do not found set add
  $do = "form";
}else{
  $do = $_GET["do"];
}


if($do == "form"){
?>
        
        <div class="container">
            <div class="mybox ">
                <h3>انشاء حساب جديد</h3>
                <hr>
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <form method="post" action="?do=addstore">
                            <div class="form-group" style="text-align: right;">
                                <label for="full_name">الاسم <span style="color:red;">*</span></label>
                                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="اسمك ثنائى" required="required" aria-describedby="helpId">
                            </div>

                            <div class="form-group" style="text-align: right;">
                                <label for="u_name">اسم المستخدم <span style="color:red;">*</span></label>
                                <input type="text" name="u_name" id="u_name" class="form-control" placeholder="اسم المستخدم للدخول" required="required" aria-describedby="helpId">
                            </div>

                            <div class="form-group" style="text-align: right;">
                                <label for="password">كلمه المرور <span style="color:red;">*</span></label>
                                <input type="password" class="form-control" name="password" id="pass" placeholder="كلمة المرور" required="required">
                            </div>

                            <div class="form-group" style="text-align: right;">
                                <label for="location">البلد <span style="color:red;">*</span></label>
                                <input type="text" name="location" id="location" class="form-control" placeholder="البلد" required="required" aria-describedby="helpId">
                            </div>
                            <br>
                            <button type="subbmit" class="btn btn-md btn-primary float-right" width="100px"><i class="fa fa-save"></i>انشاء حساب</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--end add store box-->
        


<?php
}elseif($do == "addstore"){

    $full_name    = $_POST['full_name'];
    $u_name       = $_POST['u_name'];
    $password     = $_POST['password'];
    $location     = $_POST['location'];

    $year = date('Y');
    $day = date('d');
    $manth = date('m');
    $date = $year."-".$manth."-".$day;

    $errs = array();
    if(empty($full_name)){
        $errs[] = "عفواً ، لا يمكن حفظ الحساب بدون كتابة اسمك";
    }

    if(empty($u_name)){
        $errs[] = "عفواً ، لا يمكن حفظ الحساب بدون كتابة اسم المستخدم";
    }

    if(empty($password)){
        $errs[] = "عفواً ، لا يمكن حفظ الحساب بدون كتابة كلمه المرور";
    }

    if(empty($location)){
        $errs[] = "عفواً ، لا يمكن حفظ الحساب بدون كتابة بلدك";
    }

    if(strlen($full_name) < 4){
        $errs[] = "عفواً ، الحد الأدنى لعنوان اسمك اقل من 4 حروف";
    }

    if(strlen($u_name) < 4){
        $errs[] = "عفواً ، الحد الأدنى لعنوان اسم المستخدم اقل من 4 حروف";
    }

    if(strlen($password) < 4){
        $errs[] = "عفواً ، الحد الأدنى لعنوان الباسورد اقل من 4 حروف";
    }

    if(empty($errs)){
        $stmt = $con->prepare("INSERT INTO users (full_name,u_name,password,created_at,type,country,confirm) VALUES (:full_name,:u_name,:password,:created_at,:type,:country,:confirm)");

        $stmt->execute(array(
            'full_name'      => $full_name,
            'u_name'         => $u_name,
            'password'       => sha1($password),
            'created_at'     => $date,
            'type'           => "user",
            'country'        => $location,
            'confirm'        => 0
        ));


        $_SESSION['u_name'] = $u_name;
        $_SESSION['full_name'] = $full_name;
        $_SESSION['type'] = "user";

        if ($_SESSION['type'] == "user"){
            header("Location: userHome.php");
        }

        

    }else{
        foreach($errs as $err){
            echo "<br><div class='alert alert-danger text-center'>".$err.'</div>';
        }
    }
    


//   header("Location: ../owner/index.php");

    



}




include "../inc/footer.php";
?>