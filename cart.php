<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>MY SHOP</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" media="all"/>

<style type="text/css">
body{
	background-image: url('tabz.jpg');
    background-size: cover;
}
</style>


</head>
<body>



<!--MAIN CONTAINER Starts-->
<div class="main_wrapper">



<!--header starts here-->
        <div class="header_wrapper"> 
	     <a href="index.php"><img id="img1" src="images/tab1.jpg"></a>
		<img id="img2" src="images/tab4.gif">
		</div>
<!--header ends here-->	
       


	   <div id="slim">
	  <marquee behaviour="alternate" style="color:white;"> The Ultimate Attire Shop For GIRLS</marquee>
	   </div>	
		
		<!--navigation bar starts-->
		<div id="navbar">
		<ul id="menu">
		<li><a href="index.php"> HOME</a></li>
		<li><a href="all_products.php">ALL PRODUCTS</a></li>
		<li><a href="my_account.php">MY ACCOUNT</a></li>
		<li><a href="user_register.php">SIGN UP</a></li>
		<li><a href="cart.php">SHOPPING CART</a></li>
		<li><a href="contact.php">CONTACT US</a></li>
		</ul>
		<div id="form">
		<form action="results.php" method="get" enctype="multipart/form-data">
		<input type="text" name="user_query" placeholder="Search here"/>
		<input type="submit" name="search" value="search"/>
		</form>
		</div>
		
		</div>
		<!--navigation bar ends-->
		
		
		
        <div class="content_wrapper"> 
		    <div id="left_sidebar">
			   <div id="sidebar_title">Categories</div>
			   <ul id="cats">
			   <?php getCats(); ?>
			   </ul>
			   
			   <div id="sidebar_title">Price</div>
			   <ul id="cats">
			  <?php getPrice(); ?>
			   </ul>
			</div>
		    
			
			
			
			<div id="right_content">
			
			<?php cart(); ?>
			
			 <div id="headline">
			 
			     <div id="headline_content">
				 
			        <b>Welcome Guest!</b>
					<b style='color:yellow;'>Shopping Cart:</b>
					<span>  Total Items:- <?php total_items(); ?>  Total Price:- <?php total_price(); ?> <a href="cart.php" style="color:yellow;"> Go To Cart</a></span>
			     </div> 
			 </div>
		
			
			  <div id="products_box">
			   </br>
			   <form action="" method="post" enctype="multipart/form-data">
			    </br>
			   <table align="center" width="700" bgcolor="skyblue">
			   
			   <tr align="center">
			   <th>Remove</th>
			   <th>Product</th>
			   <th>Quantity</th>
			   <th>Total Price</th>
			   
			   </tr><br>
			   
			   <?php
			   $total=0;
	
	global $db;
	$ip = getIp();
	$sel_price = "select * from cart where ip_add='$ip'";
	
	$run_price = mysqli_query($db,$sel_price);
	while($p_price=mysqli_fetch_array($run_price)){
		$pro_id=$p_price['p_id'];
		$pro_price= "select * from products where product_id='$pro_id'";
		$run_pro_price = mysqli_query($db,$pro_price);
		while($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_cost = array($pp_price['product_cost']);
			$product_title = $pp_price['product_title'];
			$product_image = $pp_price['product_img1'];
			
			$single_price = $pp_price['product_cost'];
			
			$values = array_sum($product_cost);
			$total+=$values;
			   ?>
			   
			   <tr align="center">
			   <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
			   <td><?php echo $product_title;?><br>
			   <img src="admin_area/product_images/<?php echo $product_image?>" width="160px" height="160px"/>
			   </td>
			   
			   <td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty'];?>"/></td>
			  
			  <?php
			   if(isset($_POST['update_cart']))
			   {
				   
				   $qty = $_POST['qty'];
				   $update_qty = "update cart set qty='$qty'";
				   $run_qty = mysqli_query($con,$update_qty);
				   $_SESSION ['qty'] = $qty;
				   
				   $total = $total* $qty;
				   
			   }
			   
			   
			   
			   
			   ?>
			   
			   
			   
			   
			   
			   
			   <td><?php echo "Rs.".$single_price;?></td>
			   </tr>
			   
			   
			   
			   
			   
			   
	<?php }}?>
	           <tr align="right">
			   <td colspan="4"><b>Sub Total:</b></td>
			   <td><?php echo "Rs.".$total; ?></td>
			   
			   </tr>
			   
			   <tr align="center">
			   <td><input type="submit" name="update_cart" value="Update Cart"></td>
			   <td><input type="submit" name="continue" value="Continue Shopping"></td>
			   <td><button><a href="checkout.php" style="text-decoration;none; color:black;" >Checkout</a></button></td>
			   
			   </tr>
			   
			   
			   </table>
			   </form>
			   
			   <?php
			 function updatecart(){
				   global $con;
			      $ip= getIp();
				   
			   if(isset($_POST['update_cart'])){
				   
				   foreach($_POST['remove']as $remove_id){
					 $delete_product = "delete from cart where p_id= '$remove_id' AND ip_add='$ip'"; 
				     $run_delete= mysqli_query($con,$delete_product);
					 
					 if($run_delete){
						 
						 echo "<script>window.open('cart.php','_self')</script>";
					 }
					 
				  }
				   
			   }
			   if(isset($_POST['continue'])){
				   echo "<script>window.open('index.php','_self')</script>";
			   }
			   
			   
			   echo @$up_cart = updatecart();
		
			 };
			   ?>
			   
			  
			  </div>
			
			
			
			
			
			</div>
		
		
		
		
		</div>
		
		
		
		
		
		
		<div class="footer">
          <h1 style="color:white; padding-top:20px; text-decoration:none; text-align:center; ">&copy; 2016 - all rights reserved</h1> 
 </div>

























</div>
<!--MAIN CONTAINER ends-->

</body>


</html>