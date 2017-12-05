<?php
    include_once("../database/database.php");
	include_once("../login/session.php");

	function update_user_db($name, $email, $username, $password, $telephone, $nif, $address) {
		$user_id = $_SESSION["user_id"];
        $query = "UPDATE clientes
                  SET nome_completo = :name,
					  email         = :email, 
					  username      = :username, 
                      password      = :password, 
                      telemovel     = :telephone, 
                      nif           = :nif, 
                      morada        = :address
				  WHERE id_c = $user_id";
		$values = array($name, $email, $username, $password, $telephone, $nif, $address);
		$insert = array(':name', ':email', ':username', ':password', ':telephone', ':nif', ':address');
		
		$result = execQuery($query, $insert, $values);
		
		return $result;	
}

	$user_data = user_data_db();
	$user_data1 = $user_data->fetch(PDO::FETCH_ASSOC);
	
	$password_md5 = md5($_POST["password"]);
	
	$query = "SELECT nif FROM clientes WHERE nif = :nif";
	$values = array($_POST["nif"]);
	$insert = array(':nif');
	$result = execQuery($query, $insert, $values);
	$result2 = $result->rowCount($result);
	
	if ($_POST["update"] AND ($password_md5 != $user_data1["password"])) {
		header("Location: update_dados2.php");
		exit();
	}
	
	elseif ($_POST["update"] AND $_POST["new_password"]==NULL) {
		if ($result2 > 0) header("Location: update_dados3.php");
		else {
		update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $password_md5, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
		header("Location: dados_pessoais.php");
		}
	}

	elseif ($_POST["update"] AND $_POST["new_password"]!=NULL) {
		if ($result2 > 0) header("Location: update_dados3.php");
		else {
		$new_password_md5 = md5($_POST["new_password"]);
		update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $new_password_md5, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
		header("Location: dados_pessoais.php");
		}
	}
?>
