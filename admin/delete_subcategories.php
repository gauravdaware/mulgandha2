<?php
if(isset($_GET['sid']))
{
	require_once "includes/dbconnect.php";
	$sid=$_GET['sid'];
	$sql_qry="update fk_sub_categories_tbl set trash=1 where sub_category_id=$sid";
	$res=mysqli_query($con,$sql_qry);
	if($res)
		header('location:managesubcategories.php');
	else
		echo "Not deleted";
	
}
?>