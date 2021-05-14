<?php
session_start();
include "../inc/header.php";
include "../inc/owner_navbar.php";
include "../connect.php";

$stmt=$con->prepare("SELECT confirm FROM stores WHERE store_owner=:store_owner");
$stmt->execute(array('store_owner' => $_SESSION["u_name"]));
$storname = $stmt->fetch();
$confirm_store = $storname["confirm"];

if($confirm_store == 0){
    header("Location: lock.php");
}

if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "owner"){
	header("Location: index.php");
}else{ // if is sign in 



if(isset($_GET["do"])){
	$do = filter_var($_GET["do"], FILTER_SANITIZE_STRING);
}else{
	$do = "view";
}

if($do == "add"){
	?>
    <div class="container">
		<div class="mybox">
        	<h3>اضافة مورد</h3><hr />
        	<div class="row">
            
				<div class="offset-lg-2 col-lg-8">
					<form method="post" action="?do=insert">
					
					
					<div class="form-group">
						<label for="full_name">اسم المورد<span style="color:#F00;">*</span></label>
						<input type="text" name="full_name" class="form-control" id="full_name" required>
					</div>
					
					<div class="form-group">
						<label for="email">البريد الالكتروني</label>
						<input type="email" name="email" class="form-control" id="email">
					</div>


					<div class="form-group">
						<label for="address">العنوان<span style="color:#F00;">*</span></label>
						<input type="text" name="address" class="form-control" id="address" required>
					</div>

<?php
$stmt=$con->prepare("SELECT * FROM categorys");
$stmt->execute();
$rows = $stmt->fetchAll();
?>

					<div class="form-row">
						<div class="form-group col-md-6">
						<label for="phone">رقم الهاتف<span style="color:#F00;">*</span></label>
						<input type="text" name="phone" class="form-control" id="phone" required>
						</div>
						<!-- <div class="form-group col-md-6">
						<label for="category">قسم<span style="color:#F00;">*</span></label>
						<input type="text" name="category" class="form-control" id="category" required>
						</div> -->
						<div class="form-group col-md-6">
							<label for="category">القسم</label>
							<select id="category" class="form-control" name="category" style="padding: 0;">
								<?php
									foreach($rows as $row){
										// echo $row['category_name'];
										echo '<option>'.$row['category_name'].'</option>';
									}
								?>
							</select>
						</div>
					</div>
					

					<button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>حفظ المسؤول</button>
					</form>
				</div>
        	</div>
            
        <div>
    </div>
	<?php
}else if($do == "insert"){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$supplier_full_name 	= $_POST['full_name'];
		$supplier_email 		= $_POST['email'];
		$supplier_address 		= $_POST['address'];
		$supplier_store_name 	= $_SESSION['store_name'];
		$supplier_phone 		= $_POST['phone'];
		$supplier_category 		= $_POST['category'];


	$errs = array();
    if(empty($supplier_full_name)){
        $errs[] = "عفواً ، لا يمكن حفظ المورد بدون كتابة اسمك";
    }

    if(empty($supplier_address)){
        $errs[] = "عفواً ، لا يمكن الحفظ بدون كتابة عنوان المورد";
    }

    if(empty($supplier_store_name)){
        $errs[] = "عفواً ، لا يمكن حفظ المورد بدون كتابة اسم المتجر الخاص به";
	}

	if(empty($supplier_phone)){
        $errs[] = "عفواً ، لا يمكن حفظ المورد بدون كتابة اسم رقم الهاتف الخاص به";
	}

	if(empty($supplier_category)){
        $errs[] = "عفواً ، لا يمكن حفظ المورد بدون كتابة القسم";
	}
	

    if(empty($errs)){
        $stmt = $con->prepare("INSERT INTO supplier (supplier_name,supplier_email,supplier_phone,supplier_address,supplier_category,supplier_store_name) 
		VALUES (:supplier_name,:supplier_email,:supplier_phone,:supplier_address,:supplier_category,:supplier_store_name)");

        $stmt->execute(array(
            'supplier_name'        => $supplier_full_name,
            'supplier_email'       => $supplier_email,
            'supplier_phone'       => $supplier_phone,
            'supplier_address'     => $supplier_address,
            'supplier_category'    => $supplier_category,
            'supplier_store_name'  => $supplier_store_name
        ));


        if ($_SESSION['type'] == "owner"){
            header("Location: supplier.php");
        }

    }else{
        foreach($errs as $err){
            echo "<br><div class='alert alert-danger text-center'>".$err.'</div>';
        }
    }


	}


	
}else if($do == "view"){
	

	$stmt=$con->prepare("SELECT * FROM supplier WHERE supplier_store_name=:supplier_store_name");
	$stmt->execute(array('supplier_store_name'=>$_SESSION["store_name"]));
	$rows = $stmt->fetchAll();
	

	?>
		<div class="container">
			<div class="mybox">
				<h3>الموردين</h3><hr/>
				<a href="supplier.php?do=add" class="btn btn-link"><i class="fas fa-plus"></i>اضافة مورد جديد</a>
				<div class="table-responsive">
					<table class="table table-hover table table-sm">
						<thead>
							<tr class="table-primary">
							<th scope="col">#</th>
							<th scope="col">الأسم</th>
							<th scope="col">البريد الالكتروني</th>
							<th scope="col">رقم الهاتف</th>
							<th scope="col">قسم</th>
							<th scope="col" class="text-center">حذف</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($rows as $row){
									?>
										<tr>
											<th scope="row"><?php echo $row["id"]; ?></th>
											<td><?php echo $row["supplier_name"]; ?></td>
											<td><?php echo $row["supplier_email"]; ?></td>
											<td><?php echo $row["supplier_phone"]; ?></td>
											<td><?php echo $row["supplier_category"]; ?></td>
											<td class="text-center"><a href="supplier.php?do=delete&id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> حذف</a></td>
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
	


}else if($do == "delete"){

	$id = $_GET['id'];
    $stmt=$con->prepare("SELECT * FROM supplier WHERE id = ? and supplier_store_name = ?");
    $stmt->execute(array($id,$_SESSION["store_name"]));
    $result = $stmt->fetch();
    $count = $stmt->rowCount();
        
    if(is_numeric($_GET['id'])){
        
        if($count > 0){

            if(strtolower($result['supplier_store_name']) == strtolower($_SESSION['store_name'])){
                
                // delete code 
                $stmt=$con->prepare("DELETE FROM supplier WHERE id = ?");
                $stmt->execute(array($id));

                header("Location: supplier.php");

                
                
            
            }else{
                header("Location: supplier.php");
            }
            
        }else{
            header("Location: supplier.php");
        }
    }else{
        header("Location: supplier.php");
    }



}else{
	header("Location: index.php");
}



}
include "../inc/footer.php";
?>