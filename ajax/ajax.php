<?php
	global $dbhost,$dbname,$dbusername, $dbpassword, $connect;

	$basePath = dirname(__FILE__).DIRECTORY_SEPARATOR;
	$arr = explode( '/', $basePath);
	$basePath = '';
	for($i=0; $i<count($arr)-2; $i++)
		$basePath .= '/'.$arr[$i];
	$basePath .= '/';
	echo '$basePath='.$basePath;	

	$file      = $basePath.'protected/config/main.php';
	echo $file;	
	$s = file_get_contents($file);
	
	$pos = strpos( $s, "'connectionS");
	if (!$pos) {
		$pos = strpos( $s, "'connections");
	}	
	if (!$pos) die();
	
	$pos1	= strpos( $s, ")", $pos);
	$s 		= substr( $s, $pos, $pos1 - $pos);

	$pos  = strpos( $s, "host=") + 5;
	$pos1 = strpos( $s, ";", $pos);
	$dbhost = substr( $s, $pos, $pos1 - $pos);
	
	$pos  = strpos( $s, "dbname=") + 7;
	$pos1 = strpos( $s, "'", $pos);
	$dbname = substr( $s, $pos, $pos1 - $pos);
	
	$pos  = strpos( $s, "username") + 7;
	$pos  = strpos( $s, ">", $pos);
	$pos  = strpos( $s, "'", $pos) + 1;
	$pos1 = strpos( $s, "'", $pos);
	$dbusername = substr( $s, $pos, $pos1 - $pos);
	
	$pos  = strpos( $s, "password") + 7;
	$pos  = strpos( $s, ">", $pos);
	$pos  = strpos( $s, "'", $pos) + 1;
	$pos1 = strpos( $s, "'", $pos);
	$dbpassword = substr( $s, $pos, $pos1 - $pos);
/*
	echo '<br>$dbhost='.$dbhost;
	echo '<br>$dbname='.$dbname;
	echo '<br>$dbusername='.$dbusername;
	echo '<br>$dbpassword='.$dbpassword;
	addtolog(print_r($_REQUEST,1));
*/	
	if (!isset($_REQUEST['cmd'])) die();
	db_connect();	

	if (($_REQUEST['cmd']=='done') || ($_REQUEST['cmd']=='status')){
		$id		= $_REQUEST['id'];
		$row	= array(
			'status_id'	=> $_REQUEST['status_id'],
		);
		$where	= "`id`='$id'";
		$table	= 'ProjectsParts';
		update_row($row, $table, $where);
	};	
	
	
	//--------------------------------------------------------------------------
	function db_connect() {
	global $dbhost,$dbname,$dbusername, $dbpassword, $connect;
		$connect = mysql_connect($dbhost, $dbusername, $dbpassword, $dbname)
			or die("Can't connect to MYSQL database  error".mysql_error($connect));
		echo '$connect='.$connect; print_r($connect,1)	;
		mysql_select_db($dbname);
		mysql_query("SET NAMES 'UTF8';");
	};
	//----------------------------------------------------------------------
	function get_update_str($row, $table, $where, $debug=0) {
		$sval  = '';
		$sql   = 'update `'.$table.'` set ';
		foreach($row as $name=>$value) $sql .="`$name`='$value',";
		$sql = substr($sql,0,strlen($sql)-1);
		$sval= substr($sval,0,strlen($sval)-1);
		if (strlen($where)>0) $sql.= ' where '.$where;
		return $sql;
	};
	//----------------------------------------------------------------------
	function update_row($row, $table, $where, $debug=1) {
		global $connect;
		$sql = get_update_str($row, $table, $where, $debug);
		mysql_query($sql);
//		if ($debug)
//		addtolog('update_row sql='.$sql.' error='.mysql_error($connect));
//		echo 'update_row sql='.$sql.' error='.mysql_error($connect);
		return true;
	};
  //--------------------------------------------------------------------------
  function addtolog($str, $name = 'debug.log') {
    if (file_exists($name)) { 
	if (filesize($name)>(1000*1024*1024)) { unlink($name);  $file = fopen ($name,"w+"); } else
	$file = fopen ($name,"a+"); 
    } else { $file = fopen ($name,"w+");};
    @fputs($file, date("d.m.Y h:i:s",time()).' '.$str);
    fputs($file, "\r");
    fclose ( $file );
  };
