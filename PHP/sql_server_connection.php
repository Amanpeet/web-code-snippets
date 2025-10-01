<?php
/*
*  SQL SERVER PFG DATABASE CONNECTIVITY
*
*/

error_reporting(0);
	
	//database connection details
	$serverName_pfg = "184.168.194.68"; 
	$connectionInfo_pfg = array( "Database"=>"PFGllc", "UID"=>"Client", "PWD"=>"N92#tny7");
	$connx = sqlsrv_connect( $serverName_pfg, $connectionInfo_pfg);

	if (!$connx) {
		echo "Cannot connect to database!".mysqli_error($conn);
	}
	else{
		echo "Database Connected! <br>";

			//runnin query
			$sqlx = "SELECT * from Client.payment_error";
			$resultx = sqlsrv_query( $connx, $sqlx );
			$data = sqlsrv_has_rows( $resultx );

			//loading data
			if($data != 0){				
				while( $rowx = sqlsrv_fetch_array( $resultx, SQLSRV_FETCH_ASSOC) ) {
					//check your columns here
				  echo $rowx['id'] ."<br>";
				} 
			}
			else {
	    	echo "NO data available!";
			}

	}




	//MySQLi Connection
	$serverName_pfg = "184.168.194.68"; 
	$connectionInfo_pfg = array( "Database"=>"PFGllc", "UID"=>"Client", "PWD"=>"N92#tny7");

	$link = mysqli_connect("184.168.194.68", "Client", "N92#tny7", "PFGllc");

	/* check connection */
	if (!$link) {
		echo "No connection";
	}
	else{
		echo "connection successfull!";

		$sql = "SELECT * FROM City ";
		$result = mysqli_query($link, $sql);

		if ( mysqli_num_rows($result) < 1 ){
			while ($row = mysqli_fetch_assoc($connect))
		  {		    
		    $wp_id = $row['ID'] ;
		  }
		}
		else{
			echo "resultset empty";
		}

	}
	mysqli_close($link);




	//W3 MYSQLi connection
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM MyGuests";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "id: " . $row["id"] . "<br>";
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();

?>