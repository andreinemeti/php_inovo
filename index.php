<?php 

include('connection.php'); 

$query = "SELECT * FROM users";
$result = mysqli_query( $conn, $query ); //connecting to the database and submiting my query

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inovo users</title>
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
			<h1>Inovo users</h1>
			<div class="table-responsive">
		<?php 
		//if we have any data in our db
		if ( mysqli_num_rows($result) > 0) {

			//output the data
			echo "<table class='table table-hover table-bordered'>
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Phone</th>
				</tr>
			</thead>
			<tbody>";

			//while looping trough this associative array
			while( $row = mysqli_fetch_assoc($result)) { 
				echo "<tr>
						<td>". $row["id"] ." </td>
						<td> ". $row["firstname"] ." </td>
						<td> ". $row["lastname"] ."</td>
						<td> ". $row["email"] ." </td>
						<td> ". $row["phone"] ." </td>
					</tr>";
			}
			echo "</tbody>
			</table";
		}else {
			echo "Whoops! There are no results to $db database." ;
		}

		mysqli_close($conn); //making sure we close the mysql connection for security reasons
		?>
			</div> <!-- end table responsive -->
			<a href="/inovo/insert.php" class="btn btn-warning">Add user</a>
		</div> <!-- end container -->
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>