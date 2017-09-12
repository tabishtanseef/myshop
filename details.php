<?php
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
			
			 <div id="headline">
			 
			      <div id="headline_content">
				 
			        <b>Welcome Guest!</b>
					<b style='color:yellow;'>Shopping Cart:</b>
					<span>  Total Items:- <?php total_items(); ?>  Total Price:- <?php total_price(); ?> <a href="cart.php" style="color:yellow;"> Go To Cart</a></span>
			     </div> 
			 </div>
			
			  <div id="products_box">
			    <?php
				
				if(isset($_GET['pro_id'])){
				
				$product_id = $_GET['pro_id'];
				$get_products="select * from products where product_id=$product_id";
				$run_products= mysqli_query($db, $get_products);
				 
				while($row_products=mysqli_fetch_array($run_products))
				{
					$pro_id = $row_products['product_id'];
					$pro_title = $row_products['product_title'];
					$pro_cat = $row_products['cat_id'];
					$pro_price = $row_products['price_id'];
					$pro_desc = $row_products['product_desc'];
					$pro_cost = $row_products['product_cost'];
					$pro_image1 = $row_products['product_img1'];
					$pro_image2 = $row_products['product_img2'];
					
				    echo "
				    <div id='single_product'>
				       <h3 style='color:white; text-decoration:none;'>$pro_title</h3></br>
				    <img src='admin_area/product_images/$pro_image1' width='650px' height='750px'/></br>
				    <img src='admin_area/product_images/$pro_image2' width='650px' height='750px'/></br>
				    
					<p><b>Price: Rs. $pro_cost </b></p><br>
					<p>$pro_desc</p>
					
					<a href=index.php style='float:left; color:red;'>Go Back</a>
				    
					<a href=index.php?add_cart=$pro_id><button style='float:right; text-decoration:none;'>Add to Cart</a>
				
					
					</div>
					";
				}  
				}
				
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