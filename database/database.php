<?php
  function db(){
    global $conn;
    if(!isset($conn)){
		$conn = new PDO('pgsql:host=db.fe.up.pt;dbname=ee12299', 'ee12299', 'drone');
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } else {
      return;
    }
    if(!$conn) {
      die ("An error ocurred!");
    }
//debug
//echo("\ndbg:Connected Successfully to DataBase!\n");

    $schema = $conn->exec("SET SCHEMA 'ola';");
  }
?>


<?php
function execQuery($query,$insert, $array){
  db();
global $conn;
//debug
error_log("\ndbg:SQL-Query: " . $query . " --end--");

  $result = $conn->prepare($query);
  
  for($i=0;$i<sizeof($array);$i++){
	  $result->bindParam($insert[$i], $array[$i]);
	}
  $result->execute();
  return $result;
}
?>
