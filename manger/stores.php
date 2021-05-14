<?php
session_start();
include "../inc/header.php";
include "../inc/manger_navbar.php";
include "../connect.php";

if(!isset($_SESSION["u_name"]) and $_SESSION["type"] = "manger"){
	header("Location: index.php");
}else{ // if is sign in 




if(isset($_GET["do"])){
	$do = filter_var($_GET["do"], FILTER_SANITIZE_STRING);
}else{
	$do = "view";
}



if($do == "view"){
	

	$stmt=$con->prepare("SELECT * FROM `stores`");
	$stmt->execute();
	$rows = $stmt->fetchAll();
	

	?>
		<div class="container">
			<div class="mybox">
				<h3>جميع المتاجر</h3><hr/>
				
				<div class="table-responsive">
					<table class="table table-hover table table-sm">
						<thead>
							<tr class="table-primary">
							<th scope="col">#</th>
							<th scope="col">اسم المتجر</th>
							<th scope="col">المالك</th>
							<th scope="col">العنوان</th>
							<th scope="col">رقم الهاتف</th>
							<th scope="col">البلد</th>
							<th scope="col">الفيسبوك</th>
							<th scope="col">الاميل</th>
							<th scope="col">قسم</th>
							
							<th scope="col" class="text-center">التحكم</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($rows as $row){
									?>
										<tr>
											<th scope="row"><?php echo $row["id"]; ?></th>
											<td><?php echo $row["store_name"]; ?></td>
											<td><?php echo $row["store_owner"]; ?></td>
											<td><?php echo $row["store_adderss"]; ?></td>
											<td><?php echo $row["store_phone"]; ?></td>
											<td><?php echo $row["store_country"]; ?></td>
											<td><?php echo $row["store_facebook"]; ?></td>
											<td><?php echo $row["store_email"]; ?></td>
											<td><?php echo $row["store_category"]; ?></td>
											
											
											<td class="text-center">

                                                <?php
                                                    if ($row["confirm"] == 0){
                                                        ?>
                                                            <a href="stores.php?do=conf&id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-primary">تفعيل</a>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <a href="stores.php?do=notconf&id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger">تعطيل</a>
                                                        <?php
                                                    }
                                                ?>
                                                
                                                
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
	


}else if($do == "conf"){

	if(isset($_GET["id"])){
        $id = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
        
        $stmt = $con->prepare("UPDATE stores set confirm=1 WHERE id=$id");

        $stmt->execute();

    }

    header("Location: stores.php");


}else if($do == "notconf"){

	if(isset($_GET["id"])){
        $id = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
        
        $stmt = $con->prepare("UPDATE stores set confirm=0 WHERE id=$id");

        $stmt->execute();

    }

    header("Location: stores.php");



}else{
	header("Location: index.php");
}



}
include "../inc/footer.php";
?>