<?php require_once ("header.php"); ?>

<?php
	// table.php
	
	//getting our config
	require_once ("../../config.php");
	
	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_islam");
	
	/*
		IF THERE IS ?DELETE=ROW_ID in the url
	*/

		if(isset($_GET["delete"])) {
			
			echo "Deleting row with id:".$_GET["delete"];
			
			// NOW () = current date-time
			$stmt = $mysql->prepare("UPDATE debattle_request SET deleted=NOW() WHERE id = ?");
			
			// replace the ?. The i here is an integer for the id number
			
			$stmt->bind_param ("i", $_GET["delete"]);
		
			if ($stmt->execute()){
				echo " Deleted successfully";
			}else{
				echo $stmt->error;
			}
			
			//Closes the statement, so others can use connection
			$stmt->close();
		}
	
	
	//SQL sentence // to show all results, remove ORDER 
	$stmt = $mysql->prepare("SELECT id, challengee, motion, position, visibility, start_date, end_date, characters, favcolor, created FROM debattle_request WHERE deleted IS NULL ORDER BY created LIMIT 30 ");
	
	// on the above WHERE, WHERE deleted IS NULL show only those that are not deleted. WHERE should be before the ORDER
	
	//if error in sentence
	echo $mysql->error;
	
	//variable for data for each row we will get
	$stmt->bind_result($id, $challengee, $motion, $position, $visibility, $start_date, $end_date, $characters, $favcolor, $created);

	//query
	$stmt->execute ();
	
	//Create a table
	
	$table_html = "";
	
	//add somthing to string .=
	$table_html .= "<table class='table table-bordered table-hover table-striped'>";
	$table_html .= "<tr>"; //table row
		$table_html .= "<th>ID</th>"; //table header
		$table_html .= "<th>Challengee</th>"; //table header
		$table_html .= "<th>Motion</th>"; //table header
		$table_html .= "<th>Position</th>"; //table header
		$table_html .= "<th>Visibility</th>"; //table header
		$table_html .= "<th>Start Date</th>"; //table header
		$table_html .= "<th>End Date</th>"; //table header
		$table_html .= "<th>Favourite Colour</th>"; //table header
		$table_html .= "<th>Characters</th>"; //table header
		$table_html .= "<th>Created</th>"; //table header
		$table_html .= "<th>Delete?</th>"; //table header
	$table_html .= "</tr>"; //table row closing
	
	// GET RESULTS
	// we have multiple rows, the while loop
	while ($stmt->fetch()) {
		
		// Do SOMETHING FOR EACH ROW //the dots are actual spaces
		//echo $id." ".$challengee. "<br>";
		$table_html .= "<tr>"; //start a new row
		$table_html .= "<td>" .$id. "</td>"; //add coloumns
		$table_html .= "<td>" .$challengee. "</td>"; 
		$table_html .= "<td>" .$motion. "</td>"; 
		$table_html .= "<td>" .$position. "</td>"; 
		$table_html .= "<td>" .$visibility. "</td>"; 
		$table_html .= "<td>" .$start_date. "</td>"; 
		$table_html .= "<td>" .$end_date. "</td>";
		$table_html .= "<td>" .$favcolor. "</td>";  
		$table_html .= "<td>" .$characters. "</td>"; 
		$table_html .= "<td>" .$created. "</td>";
    	$table_html .= "<td><a class= 'btn btn-danger' href='?delete=" .$id."'>Remove</a></td>";
				
	$table_html .= "</tr>"; //end row
		
	}
	$table_html .= "</table>";
	
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Debattle</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li> <a href="Debattle_b.php">Request</a></li>
		<li class="active"><a href="table_b.php"> Current</a></li>
          </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class="container">
	
		<h1> Current Debattles </h1>
		<?php echo $table_html; ?>






  </body>
</html>