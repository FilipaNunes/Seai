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

<?php
function check_admin_db() {
        global $conn;
        $user_id = $_SESSION["user_id"];

        $query = "SELECT admin
                  FROM clientes
                  WHERE id_c = $user_id";

        $result = pg_exec($conn, $query);

        $admin = pg_fetch_assoc($result);

        if ($admin["admin"] == 't'){
            return 1;
        }
        else { 
            return 0;
        }
    }
?>

<?php
function check_login_db ($username, $password){
        global $conn;
        
        $query = "SELECT id_c
                  FROM clientes
                  WHERE username = '$username' AND 
                        password = '$password'";

        $result = pg_exec ($conn, $query);
        $numrows = pg_numrows($result);
        
        if ($numrows > 0){
            $result_elem = pg_fetch_assoc ($result);
            return $result_elem["id_c"];
        }
        else
            return NULL;
    }
?>
