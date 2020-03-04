<?php 
	include('config/connect.php');
	
	//write a query
	$sql = 'SELECT dish,ingredients,id FROM dishes ORDER BY cat';

	//make query and get result
	$result = mysqli_query($conn,$sql);

	//fetch the resulting rows as an array
	$dishes = mysqli_fetch_all($result,MYSQLI_ASSOC);

	//free result variable from memory
	mysqli_free_result($result);
	//close the connection
	mysqli_close($conn);
	//print_r($dishes);
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php'); ?>
 	<h4 class="center grey-text">Dishes!</h4>

 	<div class="container">
 		<div class="row">
 			<?php foreach ($dishes as $dish) {	 ?>
 				<div class="col s6 md3">
 					<div class="card ">
 						<div class="center card-content">
 							<h6 style="color: brown; font-size: x-large;"><?php echo htmlspecialchars($dish['dish']); ?></h6><hr>
 							<img src="img/c.png" class="pic">
 							<ul>
 								<?php foreach (explode(',',$dish['ingredients']) as $ing) { ?>
 									<li style="color: #cbb09c; font-size: larger;"><?php echo htmlspecialchars($ing); ?></li>
 								<?php } ?>
 							</ul>
 						</div>
 						<div class="card-action right-align"><a class="brand-text" href="details.php?id=<?php echo $dish['id']?>">More info...</a></div>
 					</div>
 				</div>
 			<?php } ?>
 		</div>

 	</div>
 	<?php include('templates/footer.php'); ?>
 
 </html>