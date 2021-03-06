<?php

$program = new program();

class program
{
    function __construct()
    {
        $page = 'homepage';
        $arg  = NULL;
        if (isset($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
        }
        if (isset($_REQUEST['arg'])) {
            $arg = $_REQUEST['arg'];
        }
    
        $page = new $page($arg);
    }

    function __destruct()
    {
    }
}

abstract class page {
    public $content;
    
    function menu()
    {
        //menu for the homepage to display
        $menu = '<a href="./index.php?page=q1">Question 1</a> </br>';
        $menu .= '<a href="./index.php?page=q2">Question 2</a> </br>';
        $menu .= '<a href="./index.php?page=q3">Question 3</a> </br>';
        $menu .= '<a href="./index.php?page=q5">Question 5</a> </br>';
        $menu .= '<a href="./index.php?page=q6">Question 6</a> </br>';
        $menu .= '<a href="./index.php?page=q7">Question 7</a> </br>';
        $menu .= '<a href="./index.php?page=q8">Question 8</a> </br>';
        $menu .= '<a href="./index.php?page=q9">Question 9</a> </br>';
        $menu .= '<a href="./index.php?page=q10">Question 10</a> </br>';
        $menu .= '<a href="./index.php?page=q11">Question 11</a> </br> ';
        $menu .= '<a href="./index.php?page=q12">Question 12</a> </br> ';
        return $menu;
    }
    
    function __construct($arg = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->get();
        } else {
            $this->post();
        }
    }

    function get()
    {
    }

    function post()
    {
    }

    function __destruct()
    {   
        echo $this->content;
    }
	
	function dbconnect(){
		try {
		// MySQL with PDO_MYSQL
		$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
		echo 'connection to host is good'. "<br>". "\n";
		return $DBH;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	function q1235($table,$column){
	$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
	
	//perform select
	$STH = $DBH->query('
	SELECT c.unitid,c.instnm,'.$table.'.'.$column.' 
	FROM colleges as c 
	JOIN '.$table.' on c.unitid='.$table.'.unitid 
	order by '.$table.'.'.$column.' desc 
	limit 5');
	
	$STH->setFetchMode(PDO::FETCH_ASSOC);

	echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
		echo '<tr>'. "\n";
		echo '<td>'. $row['unitid'] . '</td>'. "\n";
		echo '<td>'. $row['instnm'] . '</td>'. "\n";
    		echo '<td>'. $row[$column] . '</td>'. "\n";
		echo '</tr>'. "\n";
	}
	echo '</table>'. "\n";
	}
	
	function q678($table,$column,$note){
	$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
	
	$STH = $DBH->query('
	SELECT '.$table.'.unitid, c.instnm, '.$table.'.'.$column.'/e.totalStudents as '.$note.' 
	FROM '.$table.' 
	JOIN colleges as c ON '.$table.'.unitid=c.unitid 
	JOIN enrollment as e ON c.unitid=e.unitid 
	ORDER BY '.$note.' desc 
	limit 5');
    
    $STH->setFetchMode(PDO::FETCH_ASSOC);
	
    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    	echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td> '.$note.' : '. $row[$note] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";
	}
	
	function q1112($table,$column,$note){
	$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
	
	$STH = $DBH->query('
	SELECT @2011 := '.$table.'.unitid as unitid, c.instnm,((('.$table.'.'.$column.'/(SELECT '.$column.' FROM '.$table.' WHERE unitid=@2011 and year=2010 limit 1))-1)) as '.$note.' 
	FROM '.$table.' 
	JOIN colleges as c ON '.$table.'.unitid=c.unitid
	WHERE '.$table.'.year=2011
	ORDER BY '.$note.' desc
	LIMIT 5');
	
    $STH->setFetchMode(PDO::FETCH_ASSOC);
	
    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
        echo '<td>'. $row[$note] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";
	}
}

class homepage extends page {
    function get()
    {
    $this->content .= $this->menu();
    }
}

class q1 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q1235('enrollment','totalStudents');
    }
}

class q2 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q1235('finance','liabilities');
    }
}

class q3 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q1235('finance','netAssets');
    }
}

class q5 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q1235('finance','revenues');
    }
}

class q6 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q678('finance','revenues','totalRevenuesPerStudent');
    }    
}

class q7 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q678('finance','netAssets','totalNetAssetsPerStudent');
    }    
}

class q8 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q678('finance','liabilities','totalLiabilitiesPerStudent');
    }    
}

class q9 extends page {
    function get() {
    	$this->content .= $this->menu();
    $this->content .= $this->showTable('totalStudents','2010');
    }
	
	function showTable($column,$year){
	$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
	
	if(isset($column)){
		if(isset($year)){
			$STH = $DBH->query('
			SELECT *
			FROM q9
			WHERE year='.$year.'
			ORDER BY '.$column.' desc
			LIMIT 10');
		}else{
			$STH = $DBH->query('
			SELECT *
			From q9
			ORDER BY '.$column.' desc
			LIMIT 10');
		}
	}else{
		$STH = $DBH->query('
		SELECT *
		From q9');
	}
	
    $STH->setFetchMode(PDO::FETCH_ASSOC);

    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['unitid'] . '</td>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
		echo '<td>'. $row['stabbr'] . '</td>'. "\n";
		echo '<td>'. $row['year'] . '</td>'. "\n";
		echo '<td>'. $row['totalStudents'] . '</td>'. "\n";
		echo '<td>'. $row['liabilities'] . '</td>'. "\n";
		echo '<td>'. $row['netAssets'] . '</td>'. "\n";
		echo '<td>'. $row['revenues'] . '</td>'. "\n";
        echo '</tr>'. "\n";
    }
    echo '</table>'. "\n";
	}
}

class q10 extends page {
	function get()
	{
    $this->content .= $this->menu();
    $this->content .= $this->pickState();
    }
	
	function pickState(){
	echo ('<form action="index.php?page=q10" method="post" id="pickState">
            <P>
            <LABEL for="state">PickState: </LABEL>');
  	
	echo ('<select name="states" form="pickState">');
	$STH = $this->getStates();
	while( $row = $STH->fetch() ){
	echo '<option value="'.$row['stabbr'].'">'. $row['stabbr'] . '</option>'. "\n";
	}
    	echo ('</select>'. "\n");
	
	echo ('<INPUT type="submit"> <INPUT type="reset">
         </P>
        </form>');
	}
	
	function getStates(){
	$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
	
	$STH = $DBH->query('
	select distinct stabbr 
	from colleges 
	order by stabbr asc;'
	);
	
    $STH->setFetchMode(PDO::FETCH_ASSOC);
	
	return $STH;
	}
	
	function showColleges($state){
	$DBH = new PDO("mysql:host=localhost;dbname=dj253", 'dj253', 'dj253$1234');
	
	$STH = $DBH->query('
	select instnm 
	from colleges 
	where stabbr=\''.$state. '\'
	ORDER BY instnm asc
	');
	
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
    echo '<table border="1">'. "\n";
	while( $row = $STH->fetch() ){
    		echo '<tr>'. "\n";
        echo '<td>'. $row['instnm'] . '</td>'. "\n";
    		echo '</tr>'. "\n";
    	}
    echo '</table>'. "\n";
	}
	
	function post(){
		foreach ($_POST as $key => $value) {
			$this->content .= $this->showColleges($value);
		}
		$this->content .= $this->menu();
	}       
}

class q11 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q1112('finance','liabilities','percentageChange');
    }    
}

class q12 extends page {
    function get()
    {
    $this->content .= $this->menu();
    $this->content .= $this->q1112('enrollment','totalStudents','percentageChange');
    }    
}

?> 
