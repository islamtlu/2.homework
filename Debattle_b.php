<?php require_once ("header.php"); ?>
<?php
	// require another php file
	// ../../ => 2 folders back - navigating to where the config file it
	require_once ("../../config.php");
	$everything_was_okay = true;
	
	//*******************
	//To form validation
	//*******************
	if(isset($_GET["to"])){ //if there is ?to= in the URL
		if(empty($_GET["to"])){ //if it is empty
			$everything_was_okay = false; //empty
			echo "Please enter the user you want to challenge! <br>"; // yes it is empty
		}else{
			echo "Challengee: ".$_GET["to"]."<br>"; //no it is not empty
		}
	}else{
		$everything_was_okay = false; // do not exist
	}
	//check if there is variable in the URL
	if(isset($_GET["motion"])){
		
		//only if there is motion in the URL
		//echo "there is motion";
		
		//if its empty
		if(empty($_GET["motion"])){
			//it is empty
			$everything_was_okay = false;
			echo "Please enter the motion!";
		}else{
			//its not empty
			echo "Motion: ".$_GET["motion"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as motion";
		$everything_was_okay = false;
	}
	
	//Getting the message from address
	// if there is ?name= .. then $_GET["name"]
	//$my_motion = $_GET["motion"];
	//$to = $_GET["to"];
	
	
	//echo "My motion is ".$my_motion." and is to ".$to;
	
		/***********************
	**** SAVE TO DB ********
	***********************/
	
	// ? was everything okay
	if($everything_was_okay == true){
		
		echo "Sending Debattle Request ...";
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		//1 servername: localhost or greeny server
		//2 username
		//3 password
		//4 database
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_islam");
		
		$stmt = $mysql->prepare ("INSERT INTO debattle_request (challengee, motion, start_date, end_date, characters) VALUES (?,?,?,?,?)
		");
		
		//echo error
		echo $mysql->error;
		
		//we are repalcing question marks with values
		//s - string, date, smth that is based on characters and numbers
		// i - integer, number
		// d - decimanl, float
		
		//for each question mark its type with one letter
		$stmt->bind_param ("ssssi", $_GET["to"], $_GET["motion"], $_GET["bday"], $_GET["bday2"], $_GET["characters"]);
		
		//save
		if ($stmt->execute ()){
			echo "Request sent";
		}else{
			echo $stmt->error;
		}
	
	}
	
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
        <li class="active"><a href="Debattle_b.php">Request</a></li>
		<li> <a href="table_b.php"> Current</a></li>
          </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class="container">
	
		<h1> Start A Debattle </h1>
		<h3> Everything is Challengeable </h3>
		<br>
		<form>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label for="to">User to Challenge</label>
					<input name="to" id="to" placeholder="@" type="text" class="form-control">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					<label for="motion">Motion</label>
					<input name="motion" id="motion" type="text" class="form-control">
					</div>
				</div>		
			</div>
			
			<div class="row">
				<div class="col-md-3">
				<label for="position">Position</label>
				
					<div class="radio">
					<label><input type="radio" name="position" Checked> Pro </label>
					</div>
					
					<div class="radio">
					<label><input type="radio" name="position"> Against  </label>
					</div>
				</div>			
			</div>
			<br>
			<div class="row">
				<div class="col-md-3">
				<label for="visibility">Visibility</label>
				
					<div class="radio">
					<label><input type="radio" name="visibility" Checked> Open </label>
					</div>
					
					<div class="radio">
					<label><input type="radio" name="visibility"> Closed </label>
					</div>
				</div>			
			</div>
			<br>
			<div class="row">
				<div class="col-md-3">
				<label for="bday">Start Date</label>
				
					<div class="date">
					<input type="date" class="form-control" name="bday" id="bday"> 
					</div>
				</div>	
			</div>
			<br>
			<div class="row">
			<div class="col-md-3">
			<label for="bday2">End Date</label>
				
					<div class="date">
					<input type="date" class="form-control" name="bday2" id="bday2" > 
					</div>
			</div>			
			</div>
			<br>
			<div class="row">
			<div class="col-md-3">
			<label for="colour">Choose your favourite colour</label>
				
					<div class="color">
					<input type="color" class="form-control" name="favcolor"> 
					</div>	
				</div>		
			</div>
			<br>
				
			<div class="row">
			<div class="col-md-3">
					<div class="form-group">
					<label for="characters">Set the number of characters</label>
					<input type="number" class="form-control" name="characters" min="1" max="300" class="form-control">
					</div>
				</div>			
			</div>

			<div class="row">
				<div class="col-md-3 col-sm-6">
					<input class="btn btn-success hidden-xs" type="submit" value="Start the Challenge">
					<input class="btn btn-success btn-block visible-xs-block" type="submit" value="Start the Challenge Now">
				</div>
			</div>
<br>
			<div class="row">
		
			</div>
			
		</form>




  </body>
</html>