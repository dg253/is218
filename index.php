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
	$STH = $DBH->query('SELECT f.unitid, c.instnm, f.f1a13 as totalLiabilities FROM finance as f JOIN colleges as c ON f.unitid=c.unitid ORDER BY totalLiabilities desc limit 5');
    
	// setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_ASSOC);

    echo '<table border="1">'. "\n";
    while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td>'. $row['totalLiabilities'] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";

	//perform select
	$STH = $DBH->query('SELECT f.unitid, c.instnm, f.f1a18 as totalNetAssets FROM finance as f JOIN colleges as c ON f.unitid=c.unitid ORDER BY totalNetAssets desc limit 5');
    
	// setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_ASSOC);

    echo '<table border="1">'. "\n";
    while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td>'. $row['totalNetAssets'] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";
	
	//perform select
	$STH = $DBH->query('SELECT f.unitid, c.instnm, f.f1b25 as totalRevenues FROM finance as f JOIN colleges as c ON f.unitid=c.unitid ORDER BY totalRevenues desc limit 5');
    
	// setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td>'. $row['totalRevenues'] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";

	//perform select
	$STH = $DBH->query('SELECT f.unitid, c.instnm, f.f1a13/e.efytotlt as totalLiabilitiesPerStudent FROM finance as f JOIN colleges as c ON f.unitid=c.unitid JOIN enrollment as e ON c.unitid=e.unitid ORDER BY totalLiabilitiesPerStudent desc limit 5');
    
	// setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td> liabilities\\student: '. $row['totalLiabilitiesPerStudent'] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";

	//perform select
	$STH = $DBH->query('SELECT f.unitid, c.instnm, f.f1a18/e.efytotlt as totalNetAssetsPerStudent FROM finance as f JOIN colleges as c ON f.unitid=c.unitid JOIN enrollment as e ON c.unitid=e.unitid ORDER BY totalNetAssetsPerStudent desc limit 5');
    
	// setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td> netAssets\\student: '. $row['totalNetAssetsPerStudent'] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";

	//perform select
	$STH = $DBH->query('SELECT f.unitid, c.instnm, f.f1b25/e.efytotlt as totalRevenuesPerStudent FROM finance as f JOIN colleges as c ON f.unitid=c.unitid JOIN enrollment as e ON c.unitid=e.unitid ORDER BY totalRevenuesPerStudent desc limit 5');
    
	// setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td> revenue\\student: '. $row['totalRevenuesPerStudent'] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";
	
?> 