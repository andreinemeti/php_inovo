<?php 

include('includes/connection.php'); 
include('includes/header.php');
$query = "SELECT * FROM users";
$result = mysqli_query( $conn, $query ); //connecting to the database and submiting my query

?>

	<body>
		<div class="container">
			<h1>Inovo users</h1>
			<hr/>
			
			<a href="/inovo/insert.php" class="btn btn-warning">Add user</a>
			<div class="table-responsive">
			<br/>
		<?php 
		//if we have any data in our db
		if ( mysqli_num_rows($result) > 0) {

			//output the data
			echo "<table class='table table-hover table-bordered'>
			<thead>
				<tr>
					<th class='sortable' title='Click to sort by id'>ID <span class='glyphicon glyphicon-menu-down'></span></th>
					<th class='sortable' title='Click to sort alphabetically'>First Name <span class='glyphicon glyphicon-menu-down'></th>
					<th class='sortable' title='Click to sort alphabetically'>Last Name <span class='glyphicon glyphicon-menu-down'></th>
					<th class='sortable' title='Click to sort alphabetically'>Email <span class='glyphicon glyphicon-menu-down'></th>
					<th class='sortable' title='Click to sort alphabetically'>Phone <span class='glyphicon glyphicon-menu-down'></th>
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
			</table>";
		}else {
			echo "Whoops! There are no results to $db database." ;
		}

		mysqli_close($conn); //making sure we close the mysql connection for security reasons
		?>
			</div> <!-- end table responsive -->
		</div> <!-- end container -->
		
<?php 
include('includes/footer.php'); 
?>
<br/>
	</body>
</html>