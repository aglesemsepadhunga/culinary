<?php 
	include('config/connect.php');

	$email = $dish = $ingredients = '';
	$errors=array('email'=>'', 'dish'=>'', 'ingredients'=>'');
	if (isset($_GET['submit'])) {

		//check email
		if (empty($_GET['email'])) {
			$errors['email'] = "An e-mail is required" . '<br/>';
		} else {
			$email=$_GET['email'];
			if(!(filter_var($email,FILTER_VALIDATE_EMAIL)))
				$errors['email'] ="Invalid e-mail address";
		}
		//title check
		if (empty($_GET['dish'])) {
			$errors['dish']=  "A Title is required" . '<br/>';
		} else {
			$dish=$_GET['dish'];
			if(!(preg_match('/^[a-zA-Z\s]+$/', $dish))){
				$errors['dish']= 'Invalid Title';
			}
		}
		//check ingredients
		if (empty($_GET['ingredients'])) {
			$errors['ingredients'] =  "Ingredients are required" . '<br/>';
		} else {
			$ingredients=$_GET['ingredients'];
			if(!(preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)))
				$errors['ingredients'] = 'Ingredients must be comma separated';	
		}
		//END OF CHECK
		if(array_filter($errors)){
			echo "errors in form";
		}
		else {
				$email = mysqli_real_escape_string($conn,$_GET['email']);
				$dish = mysqli_real_escape_string($conn,$_GET['dish']);
				$ingredients = mysqli_real_escape_string($conn,$_GET['ingredients']);

				//create sql
				$sql = "INSERT INTO dishes(dish,email,ingredients) VALUES('$dish','$email','$ingredients')";
				//save to database and check
				if (mysqli_query($conn,$sql)) {
					# code...sucess
					header('Location: index.php');
				}
				else{
					//error
					echo 'query error'.mysqli_error($conn);
				}


				
			}
	}
 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('templates/header.php'); ?>
 	<section class="container grey-text">
 		<h4 class="center">Add a new Dish</h4>
 		<form class="white" action="form.php" method="GET" style="border-radius: 10px">
 			<label>Enter your e-mail :</label>
 			<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
 			<div class="red-text"><?php echo $errors['email']; ?></div>
 			<label>Name of the Dish</label>
 			<input type="text" name="dish" value="<?php echo htmlspecialchars($dish); ?>">
  			<div class="red-text"><?php echo $errors['dish']; ?></div>
 			<label>Ingredients (comma separated) :</label>
 			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)	; ?>">
 			<div class="red-text"><?php echo $errors['ingredients']; ?></div>

 			<div class="center">
 				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
 			</div>
 		</form>
 	</section>
 	<?php include('templates/footer.php'); ?>
 
 </html>