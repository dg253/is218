<?php
	try {
		// MySQL with PDO_MYSQL
		$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
		echo 'connection to host is good'. "<br>". "\n";
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

	//perform select
	$STH = $DBH->query('SELECT c.unitid,c.instnm,e.efytotlt FROM colleges as c JOIN enrollment as e on c.unitid=e.unitid  order by e.efytotlt   desc limit 5');
	// setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);

	echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
		echo '<tr>'. "\n";
		echo '<td>'. $row['unitid'] . '</td>'. "\n";
		echo '<td>'. $row['instnm'] . '</td>'. "\n";
                echo '<td>'. $row['efytotlt'] . '</td>'. "\n";
		echo '</tr>'. "\n";
	}
	echo '</table>'. "\n";

	//perform select
        $STH = $DBH->query('SELECT c.unitid,c.instnm,f.f1a06 as "total assets" FROM colleges as c JOIN finance as f on c.unitid=f.unitid  order by "total assets"  desc limit 5');
        // setting the fetch mode
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        echo '<table border="1">'. "\n";
        while( $row = $STH->fetch() ){
                echo '<tr>'. "\n";
                echo '<td>'. $row['unitid'] . '</td>'. "\n";
                echo '<td>'. $row['instnm'] . '</td>'. "\n";
                echo '<td>'. $row['total assets'] . '</td>'. "\n";
                echo '</tr>'. "\n";
        }
        echo '</table>'. "\n";

?> 
