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



if($do == "view"){
	

	$stmt=$con->prepare("SELECT * FROM `cart` WHERE confirm=0 AND done=1 AND store_name=?");
	$stmt->execute(array($_SESSION['store_name']));
	$rows = $stmt->fetchAll();
	

	?>
		<div class="container">
			<div class="mybox">
				<h3>عمليات الشراء</h3><hr/>
				
				<div class="table-responsive">
					<table class="table table-hover table table-sm">
						<thead>
							<tr class="table-primary">
							<th scope="col">#</th>
							<th scope="col">اسم المنتح</th>
							<th scope="col">الكمية</th>
							<th scope="col">المشتري</th>
							<th scope="col">العنوان</th>
							<th scope="col">رقم الهاتف</th>
							<th scope="col">التاريخ</th>
							
							<th scope="col" class="text-center">التحكم</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($rows as $row){
									?>
										<tr>
											<th scope="row"><?php echo $row["id"]; ?></th>
											<td><?php echo $row["product_name"]; ?></td>
											<td><?php echo $row["product_amount"]; ?></td>
											<td><?php echo $row["user_name"]; ?></td>
											<td><?php echo $row["address"]; ?></td>
											<td><?php echo $row["phone"]; ?></td>
											<td><?php echo $row["date"]; ?></td>
											
											<td class="text-center"><a href="orders.php?do=delete&id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> حذف</a>
											<a href="orders.php?do=confirm&id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-primary">ارسال الشحنه</a></td>
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
	


}else if($do == "confirm"){

	if(isset($_GET["id"])){
        $id = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
        echo $id;
        $stmt = $con->prepare("UPDATE cart set confirm=1 WHERE id=$id");

        $stmt->execute();

    }

    header("Location: orders.php");


}else if($do == "delete"){

	if(isset($_GET["id"])){
        $id = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
        echo $id;
        $stmt = $con->prepare("DELETE FROM cart WHERE id=$id");

        $stmt->execute();

    }

    header("Location: orders.php");



}else{
	header("Location: index.php");
}



}
include "../inc/footer.php";
?>