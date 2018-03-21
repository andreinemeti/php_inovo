<?php 
include('connection.php'); 
$firstNameError = "";
$lastNameError = "";
$emailError = "";
$phoneError = "";
?>

<?php 
	if (isset ($_POST["add"])) { 
		//building a function that validates data
		function validateFormData( $formData ) {
			$formData = trim( stripslashes (htmlspecialchars($formData) ) );  
				return $formData;
		}

		$firstName = $lastName = $email = $phone = "";

		if ( !$_POST["firstname"]) { //making sure the input is not empty - also validated with HTML5 'required'
			$firstNameError = "Please enter your first name<br>"; 
		} else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["firstname"])) { //allowing only letters and whitespaces
			$firstNameError = "Only letters and white spaces alowed<br>";  
		} else {
			$firstName = validateFormData($_POST["firstname"]); //add the form data 
		}

		if ( !$_POST["lastname"]) {  // if the input email is empty
			$lastNameError = "Please enter your last name<br>";
		} else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lastname"])) {
			$lastNameError = "Only letters and white spaces alowed<br>";  
		} else {
			$lastName = validateFormData($_POST["lastname"]); 
		}

		if (!$_POST["email"]) {  
			$emailError = "Please enter your email<br>";  
		} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { 
  			$emailError = "Invalid email format.<br/> Is your e-mail not recognised? <br/>Please contact our technical support team @ +40743547720 | From 10 AM - 6 PM ET <br/> "; 
		} else {
			$email = validateFormData($_POST["email"]); //add the form data 
		}

		if (!$_POST["phone"]) {  
			$phoneError = "Please enter your phone number<br>"; 
		} else if (!preg_match("/^[0-9*#+]+$/", $_POST["phone"])) { // validate numbers and special characters
			$phoneError = "Phone number is not valid <br/>";
		} else {
			$phone = validateFormData($_POST["phone"]); //add the form data
		}

		// if all our variables are validated
		if ( $firstName && $lastName && $email && $phone) { 
			
			//we check to see if the e-mail already exists in the database
			$query = mysqli_query($conn, "SELECT * FROM Users WHERE email='".$email."'");

			if(mysqli_num_rows($query) > 0){

    			echo "<div class='alert alert-danger'>Error! The email already exists in our database.</div>";
    	// if everything is ok, we add the new user to our Inovo Users DB
		} else {
			$query = "INSERT INTO users (id, firstname, lastname, email, phone) VALUES (NULL, '$firstName', '$lastName', '$email', '$phone')";

			if (mysqli_query($conn, $query) ) { //if we have connected successfully and added the query
				echo "<div class='alert alert-success'>Success! The user was added to the database</div>";
			}else{
				echo "Error: ". $query . "<br/>" .mysqli_error($conn);
			}
		}
		}

	} //end of the if statement ($_POST["add"])) 

//making sure we are closing the connection for security reasons 
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Add new user</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
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
				<input type="text" placeholder="First name" name="firstname" maxlength="25" required>
				<br/><br/>

				<small class="text-danger">* <?php echo $lastNameError; ?></small>
				<input type="text" placeholder="Last name" name="lastname" maxlength="25" required>
				<br/><br/>

				<small class="text-danger">* <?php echo $emailError; ?></small>
				<input type="email" placeholder="Email" name="email" maxlength="45" required>
				<br/><br/>

				<small class="text-danger">* <?php echo $phoneError; ?></small>
				<input type="text" placeholder="Phone number" name="phone" maxlength="25" required>

				<br/><br/>


				<input type="submit" class="btn btn-warning" name="add" value="Add user">
				<a href="/inovo/index.php" class="btn btn-default">Back</a>
			</form>


	</div> <!-- end container -->
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>