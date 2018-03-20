<?php 
$firstNameError = "";
$lastNameError = "";
$emailError = "";
$phoneError = "";
?>

<?php 

include('connection.php'); 


if (isset ($_POST["add"])) { 
		//building a function that validates data
		function validateFormData( $formData ) {
			$formData = trim( stripslashes (htmlspecialchars($formData) ) );  
				return $formData;

		}


		$firstName = $lastName = $email = $phone = "";
		if ( !$_POST["firstname"]) { 
			$firstNameError = "Please enter your first name<br>"; //add the form data 


		}else {
			$firstName = validateFormData($_POST["firstname"]); //add the form data 
		}

		if ( !$_POST["lastname"]) {  // if the input email is empty
			$lastNameError = "Please enter your last name<br>";
	
		}else {
			$lastName = validateFormData($_POST["lastname"]); //add the form data 
		}

		if (!$_POST["email"]) {  
			$emailError = "Please enter your email<br>"; //add the form data 
	
		}else {
			$email = validateFormData($_POST["email"]); //add the form data 
		}

		if (!$_POST["phone"]) {  
			$phoneError = "Please enter your phone number<br>"; 
		}
		else {
			$phone = validateFormData($_POST["phone"]); //add the form data
		}


		if ( $firstName && $lastName && $email && $phone) {
			$query = "INSERT INTO users (id, firstname, lastname, email, phone) VALUES (NULL, '$firstName', '$lastName', '$email', '$phone')";

			if (mysqli_query($conn, $query) ) {
				echo "<div class='alert alert-success'>Success! The user was added to the database</div>";
			}else{
				echo "Error: ". $query . "<br/>" .mysqli_error($conn);
			}
		}
	}	
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Add new user</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body>
		<div class="container">
			<h1>Add a new user</h1>
			<p class="text-danger">* Field marked with * are required</p>
			<form action="<?php echo htmlspecialchars ( $_SERVER["PHP_SELF"] ); ?>" method="post"> 

				<small class="text-danger">* <?php echo $firstNameError; ?></small>
				<input type="text" placeholder="First name" name="firstname">
				<br/><br/>

				<small class="text-danger">* <?php echo $lastNameError; ?></small>
				<input type="text" placeholder="Last name" name="lastname">
				<br/><br/>

				<small class="text-danger">* <?php echo $emailError; ?></small>
				<input type="text" placeholder="Email" name="email">
				<br/><br/>

				<small class="text-danger">* <?php echo $phoneError; ?></small>
				<input type="text" placeholder="Phone number" name="phone">

				<br/><br/>


				<input type="submit" class="btn btn-warning" name="add" value="Add user">
				<a href="/inovo/index.php" class="btn btn-default">Back</a>
			</form>

			<div class="table-responsive">
		</div> <!-- end table responsive -->
	</div> <!-- end container -->
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>