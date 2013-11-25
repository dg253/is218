<?php
	try {
		// MySQL with PDO_MYSQL  
		$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
		echo 'connection to host is good'. "<br>";
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

	//create table
	$STH = $DBH->prepare("
		CREATE TABLE colleges(
		unitid INT NOT NULL, 
		instnm VARCHAR(100) NOT NULL, 
		addr VARCHAR(100) NOT NULL, 
		city VARCHAR(30) NOT NULL, 
		stabbr VARCHAR(2) NOT NULL, 
		zip VARCHAR(10) NOT NULL, 
		webaddr VARCHAR(100) NOT NULL,
		PRIMARY KEY ( unitid ) 
		);
 	");
	$STH->execute();
	// perform insert
	//$STH = $DBH->prepare("INSERT INTO departments (dept_no, dept_name) values ('253', 'dave')");
	//$STH->execute();
	
	/* perform select */
	//$STH = $DBH->query('SELECT last_name,first_name from employees where last_name="Baba" order by first_name asc');
	
	// setting the fetch mode
	//$STH->setFetchMode(PDO::FETCH_ASSOC);

	/*
	while( $row = $STH->fetch() ){
		echo $row['last_name'] . ", ";
		echo $row['first_name'] . ". <br>";
	}
	*/

?> 
