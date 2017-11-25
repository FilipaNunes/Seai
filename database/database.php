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
  $result->setFetchMode(PDO::FETCH_ASSOC);
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
		$query = "SELECT id_c
                  FROM clientes
                  WHERE username = :username AND
                        password = :password";
		$values = array($username, $password);
		$insert = array(':username', ':password');

		$result = execQuery($query, $insert, $values);

        $numrows = $result->rowCount($result);

        if ($numrows > 0){
            $result_elem = $result->fetch();
            return $result_elem["id_c"];
        }
        else
            return NULL;
    }
?>

<?php
function user_data_db (){
		$user_id = $_SESSION["user_id"]; /* lê o id do utilizador já registado por sessão */

		$query = "SELECT *
                  FROM clientes
                  WHERE id_c = :id";
		$values = array($user_id);
		$insert = array(':id');

		$result = execQuery($query, $insert, $values);

        return $result;
    }
?>

<?php
function get_encomendas_db (){
		$user_id = $_SESSION["user_id"];

		$query = "SELECT * FROM faz
				  JOIN encomenda ON faz.id_e=encomenda.id_e
				  WHERE id_c = :id";
		$values = array($user_id);
		$insert = array(':id');

		$result = execQuery($query, $insert, $values);

        return $result;
    }
?>

<?php
function getMonthReceitas(){
  global $conn;

  $date = getdate();

  $dateString = $date['year'] . "-" . $date['mon'] . "-01";

  $stmt = $conn->prepare('SELECT *
                          FROM receitas
                          WHERE data = ?');
  $stmt->execute(array($dateString));
  return $stmt->fetch();

}
?>

<?php
function getAverageReceitas(){
  global $conn;

  $date = getdate();

  $dateString = $date['year'] . "-" . $date['mon'] . "-01";

  $stmt = $conn->prepare('SELECT avg("0a1") as "0a1", avg("1a2") as "1a2", avg("2a3") as "2a3", avg("3a4") as "3a4", avg("outras") as "outras"
                          FROM "receitas"
                          WHERE "id"<(SELECT "id"
                                      FROM "receitas"
                                      WHERE "data"= ?
                                    );');
  $stmt->execute(array($dateString));
  return $stmt->fetch();

}
?>

<?php
function getMonthDespesas(){
  global $conn;

  $date = getdate();

  $dateString = $date['year'] . "-" . $date['mon'] . "-01";

  $stmt = $conn->prepare('SELECT *
                          FROM despesas
                          WHERE data = ?');
  $stmt->execute(array($dateString));
  return $stmt->fetch();

}
?>

<?php
function getAverageDespesas(){
  global $conn;

  $date = getdate();

  $dateString = $date['year'] . "-" . $date['mon'] . "-01";

  $stmt = $conn->prepare('SELECT avg("salarios") as "salarios", avg("aguagas") as "aguagas", avg("energia") as "energia", avg("aluguer") as "aluguer", avg("manutencao") as "manutencao", avg("outras") as "outras"
                          FROM "despesas"
                          WHERE "id"<(SELECT "id"
                                      FROM "despesas"
                                      WHERE "data"= ?
                                    );');
  $stmt->execute(array($dateString));
  return $stmt->fetch();

}
?>
