<!-- This is the form for entering soccer players -->

<?php
	include_once('top.php');
	$pageTitle = "Soccer players - " . $Title;
?>

<?php
	// Generating pull down menu for club teams
	
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "SELECT id, name, country FROM hw4ClubTeam ORDER BY country, name;";
	
	// run the query
	$result = queryDB($query, $db);
	
	// options for club teams
	$clubTeamOptions = "";
	
	// go through all club teams and put together pull down menu
	while ($row = nextTuple($result)) {
		$clubTeamOptions .= "\t\t\t";
		$clubTeamOptions .= "<option value='";
		$clubTeamOptions .= $row['id'] . "'>" . $row['name'] . " (" . $row['country'] . ")</option>\n";
	}
?>

<html>
<head>
	<title>
		<?php echo $pageTitle; ?>
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
	<h1><?php echo $pageTitle ?></h1>
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
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$clubteamid = $_POST['clubteamid'];
	$nationalteam = $_POST['nationalteam'];
	
	// check to make sure we have a last name
	if (!$lname) {
		punt("Please enter a last name");
	}
	
	// set up my query
	$query = "INSERT INTO hw4SoccerPlayer(lname, fname, clubteamid, nationalteam) VALUES ('$lname', '$fname', $clubteamid, '$nationalteam');";
	
	// run the query
	$result = queryDB($query, $db);
	
	// tell users that we added the player to the database
	echo "<div class='panel panel-default'>\n";
	echo "\t<div class='panel-body'>\n";
    echo "\t\tThe soccer player " . $fname . " " . $lname . " was added to the database\n";
	echo "</div></div>\n";
	
}
?>

<!-- Form to enter soccer players -->
<div class="row">
<div class="col-xs-12">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-group">
	<label for="fname">First Name</label>
	<input type="text" class="form-control" name="fname"/>
</div>

<div class="form-group">
	<label for="lname">Last Name</label>
	<input type="text" class="form-control" name="lname"/>
</div>

<div class="form-group">
	<label for="clubteamid">Club Team</label>
	<select class="form-control" name="clubteamid">
<?php echo $clubTeamOptions; ?>
	</select>
</div>

<div class="form-group">
	<label for="nationalteam">National Team</label>
	<input type="text" class="form-control" name="nationalteam"/>
</div>
<button type="submit" class="btn btn-default" name="submit">Add</button>

</form>

</div>
</div>

<!----------------->
<!---List players--->
<!----------------->
<div class="row">
<div class="col-xs-12">
	<h2><?php echo $pageTitle ?></h2>
</div>
</div>

<div class="row">
<div class="col-xs-12">
<table class="table table-hover">

<!-- Titles for table -->
<thead>
<tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Club Team</th>
	<th>National Team</th>
</tr>
</thead>

<tbody>
<?php
	// set up my query
	$query = "SELECT p.fname, p.lname, c.name, p.nationalteam FROM hw4SoccerPlayer as p, hw4ClubTeam as c WHERE p.clubteamid = c.id ORDER BY p.lname;";
	
	// run the query
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n <tr>";
		echo "<td>" . $row['fname'] . "</td>";
		echo "<td>" . $row['lname'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['nationalteam'] . "</td>";
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