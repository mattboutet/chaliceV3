<?php
require_once('simple_html_dom.php');

$url = "http://novareresbiercafe.com/draught.php";

$html = file_get_html($url);


//this loops through everything in the list (200+ beers) for each item on tap (~30 beers)- not very efficient
foreach($html->find('.draughts_reg p') as $e){
	if (strlen(html_entity_decode($e->innertext)) > 2){
		//hacky way of finding actual items and avoiding poorly indicated separators
		if (!strpos($e->innertext, 'Draughts') &&
			!strpos($e->innertext, 'On Draught') &&  
			!strpos($e->innertext, 'On Cask') &&
			!strpos($e->innertext, 'Weak Sauce') &&
			!strpos($e->innertext, 'Bottle Pours') &&
			!strpos($e->innertext, 'REGULAR DRAUGHTS') &&
			!strpos($e->innertext, 'MAINE DRAUGHTS') &&
			strlen(html_entity_decode($e->innertext)) > 2) {
			
			$searchstring = str_replace(' ', '+', $e->innertext);
			
			$searchstring = 'http://www.google.com/search?q=site:beeradvocate.com+'.urlencode($searchstring).'&btnI=I';
			$search_link = '<a href="'.$searchstring.'">'.$e->innertext.'</a>';
			//$beer_name = html_entity_decode($e->innertext);
			//echo $beer_name . "\n";
			//if (levenshtein($beer_name, html_entity_decode($e->innertext)) < 4 ) {
					
			$list[] = array(
							'tap_name' => $e->innertext,
							'tap_link' => $search_link,
							);
		}
	}
}

$db = new mysqli("localhost", "root", "7gpf6688*", "chalice");
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	exit();
}

if (!$db->query("TRUNCATE TABLE taps")){
	echo "Couldn't empty table, exiting";
	exit();
}
if (!($stmt = $db->prepare("INSERT INTO taps (tap_name, tap_link) VALUES (?,?)"))) {
	echo "Prepare failed: (" . $db->errno . ") " . $db->error;
	exit();
}
$stmt->bind_param('ss', $tap_name, $tap_link);

foreach($list as $list_item){
	$tap_name = $list_item['tap_name'];
	$tap_link = $list_item['tap_link'];
	$stmt->execute();
}
$stmt->close();
$db->query("COMMIT");

/*$dsn = 'mysql://root:7gpf6688*@localhost:3306/chalice'; 
//no db?
$db = DB::connect($dsn);
			
if (DB::isError($db)) {

	$error = $db->getMessage();
	
	if($error == 'DB Error: no database selected'){
	
	//possible timeout, try to reconnect:
	
	if(strstr($dsn, 'mysql://')){
		
		mysql_close();
	}
	
	$db = DB::connect($dsn);
}

if (DB::isError($db)) {
	
	$alert->report('failure', 'db_connect_err', $_LABEL['db_err_warning'], true);
	
	$alert->send_bug_email('db_connect_err', $error . ' : ' . $dsn);
		
		$db = null;
		
	}else{
		
		$error = null;
	}
}
print_r('asdf');*/
if(!isset($error)){
	
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	//????
	print_r('db connect success');
}