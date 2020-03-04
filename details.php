<?php 
	include('config/connect.php');

	if (isset($_POST['delete'])) {
		$idToDelete=mysqli_real_escape_string($conn,$_POST['idToDelete']);

		$sql = "DELETE FROM dishes WHERE id=$idToDelete";

		if(mysqli_query($conn,$sql)){
			header('Location:index.php');
		}else{
			echo 'Query error'.mysqli_error($conn);
		}
	}
	//check GET request ,id parameter
	if(isset($_GET['id'])){
		$id = mysqli_real_escape_string($conn,$_GET['id']);
		//make sql
		$sql = "SELECT * FROM dishes WHERE id=$id";
		//get query results
		$result=mysqli_query($conn,$sql);
		//fetch result in array format
		$dish = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);
		//print_r($dish);
	}
 ?>
 <!DOCTYPE html>
 <html>
  	<?php include('templates/header.php'); ?>
  	<div class="container center brown-text ">
  		<?php if($dish): ?>
  			<h4><?php echo htmlspecialchars($dish['dish']); ?></h4>
  			<p>Created by: <?php echo htmlspecialchars($dish['email']); ?></p>
  			<p><?php echo date($dish['cat']); ?></p>
  			<h5>Ingredients:</h5>
  			<p><?php echo htmlspecialchars($dish['ingredients']); ?></p>

  			<!-- DELETE FORM -->
  			<form action="details.php" method="POST">
  				<input type="hidden" name="idToDelete" value="<?php echo $dish['id']; ?>">
  				<input type="submit" name="delete" value="Delete This" class="btn brand">
  			</form>
  		<?php else : ?>	
  			<h5>This Dish no longer exists....sed lyf</h5>
  		<?php endif; ?>
  	</div>
 	<?php include('templates/footer.php'); ?>

 </html>