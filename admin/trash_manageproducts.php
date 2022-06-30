<?php
/*
	Author: Gaurav Daware
	Created on:13:07:2018
	Purpose:To manage trash_products
*/
session_start();
if(empty($_SESSION['email'])){
	header('location:index.php');
}
	require_once "includes/dbconnect.php";
	extract($_POST);
	if(isset($search))
{
	$sql_qry="select * from fk_products_tbl where prod_name like '$searchstr%' and trash=1";
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Remove Products</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/flag-icon.min.css">
    <link rel="stylesheet" href="css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<style>
th,td{
	text-align: left;
	
}
</style>
</head>
<body>
        <!-- Left Panel -->
<?php
		require_once("includes/menu.php");
		
?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php require_once("includes/header.php")?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Remove Products</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Products</a></li>
                            <li class="active">Remove Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
					<form method="post" action="" style="background-color: #f7f7f7;">
						<input type="text" name="searchstr" id="searchstr" placeholder="Search Subcategory" style="width:400px;height:38px;border:1px solid gray;border-radius:10px;margin-left:10px;" />
						<button type="submit" name="search" class="btn btn-primary" value="Search" >Search</button>
						<button type="submit" name="delete" value="Delete" class="btn btn-success" style="margin-left:300px">Active</button>
						<button type="submit" name="delete" value="Delete" class="btn btn-secondary">In-Active</button>
						<button type="submit" name="delete" value="Delete" class="btn btn-danger">Delete</button>
					</form>
					
                        <div class="card-header">
                            <strong class="card-title">Remove Products</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col" >Product Code</th>
                                  <th scope="col">Product Name</th>
								  <th scope="col">Product Image</th>
                                  <th scope="col">Brand</th>		
								  <th scope="col">MRP</th>
								  <th scope="col">SP</th>
								  <th scope="col">Ship Charge</th>
								  <th scope="col">Stock</th>
								  <th scope="col">Added On</th>
								  <th scope="col">Status</th>
								  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
					<?php
						  /*getting subcategories*/
						 if(empty($searchstr))
						  {
						  $sql_qry="select * from fk_products_tbl where trash=1";
						  
						  }
						  $res=mysqli_query($con,$sql_qry);
						  $count=mysqli_num_rows($res);
						  if($count>0){
						  $i=1;
						  while($row=mysqli_fetch_assoc($res))
						  {
						  ?>
                            <tr>
								<th scope="row"><?php echo $i;?></th>
								<td><?php echo $row['prod_code'];?> </td>
								<td><?php echo $row['prod_name'];?></td>
								<td>
									<img src="<?php echo '../uploads/products/'.$row['prod_image'];?>" border="1px solid" height="50px" width="60px" style="border-radius:10px; box-shadow: 0 0 10px green;">
								</td>
								<td><?php echo $row['prod_brand'];?> </td>
								<td><?php echo $row['prod_mrp'];?> </td>
								<td><?php echo $row['prod_sp'];?> </td>
								<td><?php echo $row['prod_shipping_charge'];?> </td>
								<td><?php echo $row['prod_stock'];?> </td>
								<td><?php echo $row['added_on'];?> </td>
                              <td>
							  <?php
							  if($row['prod_status']==1)
								  echo "<p style='color:green'>Active</p>";
							  else
								  echo "<p style='color:red'>In-Active</p>";
							  ?>
							  </td>
							  
                               <td>
								  <a style="color:red; border-bottom:1px solid;" href="db_delete_products.php?sid=<?php echo $row['prod_id'];?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
								  <a style="color:blue; border-bottom:1px solid;" href="restore_products.php?sid=<?php echo $row['prod_id'];?>" onclick="return confirm('Are you sure to Re-store?')">Re-store</a>
							   </td>
                          </tr>
						  <?php
						  $i++;
						  }
						  }
						   else
						  {
							  ?>
							<tr>
							<td colspan="7"><p style="color:red;text-align:center">No records found..!</p></td></tr>
							  <?php
						  }
						  ?>
                      </tbody>
                  </table>
                        </div>
                    </div>
                </div>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="js/vendor/jquery-2.1.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>


</body>
</html>
