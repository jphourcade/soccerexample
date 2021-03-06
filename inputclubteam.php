<?php
	include_once('top.php');
?>

<html>
<head>
	<title>
		<?php echo "Club Teams - " . $Title; ?>
	</title>

	<!-- Following three lines are necessary for running Bootstrap -->
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	
</head>

<body>

<div class="container">

<!-- Page header -->
<div class="row">
<div class="col-xs-12">
<div class="page-header">
	<h1><?php echo "Club Teams - " . $Title; ?></h1>
		<p><a href="logout.php">Logout</a></p>
</div>
</div>
</div>

<?php
// Back to PHP to perform the search if one has been submitted. Note
// that $_POST['submit'] will be set only if you invoke this PHP code as
// the result of a POST action, presumably from having pressed Submit
// on the form we just displayed above.
if (isset($_POST['submit'])) {
//	echo '<p>we are processing form data</p>';
//	print_r($_POST);

	// get data from the input fields
	$name = $_POST['name'];
	$country = $_POST['country'];
	
	// check to make sure we have a last name
	if (!$name) {
		punt("Please enter a name");
	}
	
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "INSERT INTO hw4ClubTeam(name, country) VALUES ('$name', '$country');";
	
	// run the query
	$result = queryDB($query, $db);
	
	// tell users that we added the player to the database
	echo "<div class='panel panel-default'>\n";
	echo "\t<div class='panel-body'>\n";
    echo "\t\tThe club team " . $name . " was added to the database\n";
	echo "</div></div>\n";
	
}
?>

<!-- Form to enter club teams -->
<div class="row">
<div class="col-xs-12">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-group">
	<label for="name">Name</label>
	<input type="text" class="form-control" name="name"/>
</div>

<div class="form-group">
	<label for="country">Country</label>
	<input type="text" class="form-control" name="country"/>
</div>

<button type="submit" class="btn btn-default" name="submit">Add</button>

</form>

</div>
</div>

<!----------------->
<!---List club teams--->
<!----------------->
<div class="row">
<div class="col-xs-12">
	<h2><?php echo "Club teams"; ?></h2>
</div>
</div>

<div class="row">
<div class="col-xs-12">
<table class="table table-hover">

<!-- Titles for table -->
<thead>
<tr>
	<th>Name</th>
	<th>Country</th>
</tr>
</thead>

<tbody>
<?php
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "SELECT * FROM hw4ClubTeam ORDER BY name;";
	
	// run the query
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n <tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['country'] . "</td>";
		echo "</tr>";
	}
?>

</tbody>
</table>
</div>
</div>

</div> <!-- closing bootstrap container -->
</body>
</html>