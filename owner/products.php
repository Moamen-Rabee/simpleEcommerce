<?php
session_start();
include "../inc/header.php";
include "../inc/owner_navbar.php";
include "../connect.php";

if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "owner"){
	header("Location: index.php");
}else{ // if is sign in 



$stmt=$con->prepare("SELECT confirm FROM stores WHERE store_owner=:store_owner");
$stmt->execute(array('store_owner' => $_SESSION["u_name"]));
$storname = $stmt->fetch();
$confirm_store = $storname["confirm"];

if($confirm_store == 0){
    header("Location: lock.php");
}


if(isset($_GET["do"])){
	$do = filter_var($_GET["do"], FILTER_SANITIZE_STRING);
}else{
	$do = "view";
}

if($do == "add"){
	?>
    <div class="container">
		<div class="mybox">
        	<h3>اضافة منتج جديد</h3><hr />
        	<div class="row">
            
				<div class="offset-lg-2 col-lg-8">
					<form method="post" action="?do=insert" enctype="multipart/form-data">


<?php
$stmt=$con->prepare("SELECT * FROM categorys");
$stmt->execute();
$rows = $stmt->fetchAll();
?>

					<div class="form-row">
						<div class="form-group col-md-6">
						<label for="product_name">اسم المنتج <span style="color:#F00;">*</span></label>
						<input type="text" name="product_name" class="form-control" id="product_name" required>
						</div>
						<div class="form-group col-md-6">
							<label for="category">القسم <span style="color:#F00;">*</span></label>
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

					<?php
$stmt=$con->prepare("SELECT * FROM supplier WHERE supplier_store_name=:supplier_store_name");
$stmt->execute(array("supplier_store_name" => $_SESSION["store_name"]));
$rows = $stmt->fetchAll();
?>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="product_supplier">المورد <span style="color:#F00;">*</span></label>
							<select id="product_supplier" class="form-control" name="product_supplier" style="padding: 0;">
								<?php
									foreach($rows as $row){
										// echo $row['category_name'];
										echo '<option>'.$row['supplier_name'].'</option>';
									}
								?>
							</select>
						</div>
						<div class="form-group col-md-6">
						<label for="product_qty">الكمية <span style="color:#F00;">*</span></label>
						<input type="text" name="product_qty" class="form-control" id="product_qty" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
						<label for="product_buy_price">سعر الشراء <span style="color:#F00;">*</span></label>
						<input type="text" name="product_buy_price" class="form-control" id="product_buy_price" required>
						</div>
						<div class="form-group col-md-6">
						<label for="product_sale_price">سعر البيع <span style="color:#F00;">*</span></label>
						<input type="text" name="product_sale_price" class="form-control" id="product_sale_price" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="product_img">صورة المنتج <span style="color:#F00;">*</span></label>
							<input type="file" class="form-control-file" id="product_img" name="product_img">
						</div>
					</div>
					
					<button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>حفظ المنتج</button>
					</form>
				</div>
        	</div>
            
        <div>
    </div>
	<?php
}else if($do == "insert"){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$year = date('Y');
        $day = date('d');
        $manth = date('m');
        $date = $year."-".$manth."-".$day;
        
        $errs = array();
        $product_name   = $_POST['product_name'];
        $product_supplier  = $_POST['product_supplier'];
        $product_qty  = $_POST['product_qty'];
		$product_date  = $date;
		$product_category  = $_POST['category'];
		$product_sale_price  = $_POST['product_sale_price'];
		$product_buy_price  = $_POST['product_buy_price'];
		$product_store_name  = $_SESSION["store_name"];
		
		$img            = $_FILES['product_img'];

        // IMG INFO
        $img_name = $img['name'];
        $img_size = $img['size'];
        $img_temp = $img['tmp_name'];
        
        
        if(!$img['error'] == 4){

            $exe_name = explode('.',$img_name);
            $exe_name = strtolower(end($exe_name));
            $allwed = array('png','jpg');
            if(!in_array($exe_name,$allwed)){
                $errs[] = 'عفواً انت لم تختار صورة بعد';
            }
            if($img_size > 3000000){
                $errs[] = 'عفواً ان حجم الصورة كبير جداً';
            }
            if(empty($errs)){
                $new_name = uniqid('',false).'.'.$exe_name;
                echo $new_name;
                move_uploaded_file($img['tmp_name'],'uplouds/product_images/'.$new_name);
            }
        }else{
            $new_name = "main_image.png";
        }

        


        if(empty($product_name)){
            $errs[] = "عفواً ، لا يمكن حفظ المنتج بدون اسم";
		}
		
        if(empty($product_qty)){
            $errs[] = "عفواً ، لا يمكن حفظ المنتج بدون تحديد الكمية";
		}

		if(empty($product_supplier)){
            $errs[] = "عفواً ، لا يمكن حفظ المنتج بدون تحديد المورد";
		}

		if(empty($product_sale_price)){
            $errs[] = "عفواً ، لا يمكن حفظ المنتج بدون تحديد سعر البيع";
		}

		if(empty($product_buy_price)){
            $errs[] = "عفواً ، لا يمكن حفظ المنتج بدون تحديد سعر الشراء";
		}
		

        if(empty($errs)){
            $stmt = $con->prepare("INSERT INTO products (product_name,product_supplier,product_qty,product_date,product_category,product_sale_price,product_buy_price,product_img,product_store_name,product_confirm) 
                                VALUES (:product_name,:product_supplier,:product_qty,:product_date,:product_category,:product_sale_price,:product_buy_price,:product_img,:product_store_name,:product_confirm)");

            $stmt->execute(array(
                'product_name'       => $product_name,
                'product_supplier'       => $product_supplier,
                'product_qty'       => $product_qty,
                'product_date'       => $product_date,
                'product_category'       => $product_category,
                'product_sale_price'       => $product_sale_price,
                'product_buy_price'       => $product_buy_price,
                'product_img'       => $new_name,
                'product_store_name'       => $product_store_name,
                'product_confirm'       => 0
            ));

            header("Location: products.php");
        }else{
            foreach($errs as $err){
                echo "<br><div class='alert alert-danger text-center'>".$err.'</div>';
            }
        }

        


    }else{ // if not get with post method go to add user
        header("Location: products.php?do=add");
    }


	
}else if($do == "view"){
	

	$stmt=$con->prepare("SELECT * FROM products WHERE product_store_name=:product_store_name");
	$stmt->execute(array('product_store_name'=>$_SESSION["store_name"]));
	$rows = $stmt->fetchAll();
	

	?>
		<div class="container">
			<div class="mybox">
				<h3>المنتجات</h3><hr/>
				<a href="products.php?do=add" class="btn btn-link"><i class="fas fa-plus"></i>اضافة منتج جديد</a>
				<div class="table-responsive">
					<table class="table table-hover table table-sm">
						<thead>
							<tr class="table-primary">
							<th scope="col">#</th>
							<th scope="col">اسم المنتح</th>
							<th scope="col">الصورة</th>
							<th scope="col">الكمية</th>
							<th scope="col">القسم</th>
							<th scope="col">سعر البيع</th>
							<th scope="col">سعر الشراء</th>
							<th scope="col" class="text-center">حذف</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($rows as $row){
									?>
										<tr>
											<th scope="row"><?php echo $row["id"]; ?></th>
											<td><?php echo $row["product_name"]; ?></td>
											<td>
												<img src="uplouds/product_images/<?php echo $row["product_img"]; ?>" width="50px" height="50px">
											</td>
											<td><?php echo $row["product_qty"]; ?></td>
											<td><?php echo $row["product_category"]; ?></td>
											<td><?php echo $row["product_sale_price"]; ?></td>
											<td><?php echo $row["product_buy_price"]; ?></td>
											<td class="text-center"><a href="products.php?do=delete&id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> حذف</a></td>
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
    $stmt=$con->prepare("SELECT * FROM products WHERE id = ? and product_store_name = ?");
    $stmt->execute(array($id,$_SESSION["store_name"]));
    $result = $stmt->fetch();
    $count = $stmt->rowCount();
        
    if(is_numeric($_GET['id'])){
        
        if($count > 0){

            if(strtolower($result['product_store_name']) == strtolower($_SESSION['store_name'])){
                
                // delete code 
                $stmt=$con->prepare("DELETE FROM products WHERE id = ?");
                $stmt->execute(array($id));

                header("Location: products.php");

                
                
            
            }else{
                header("Location: products.php");
            }
            
        }else{
            header("Location: products.php");
        }
    }else{
        header("Location: products.php");
    }



}else{
	header("Location: index.php");
}



}
include "../inc/footer.php";
?>