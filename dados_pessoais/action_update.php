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
	
	if ($_POST["update"] AND ($password_md5 != $user_data1["password"])) {
		header("Location: dados_pessoais2.php");
		exit();
	}
	
	elseif ($_POST["update"] AND $_POST["new_password"]==NULL) {
		update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $password_md5, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
		header("Location: dados_pessoais.php");
	}

	elseif ($_POST["update"] AND $_POST["new_password"]!=NULL) {
		$new_password_md5 = md5($_POST["new_password"]);
		update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $new_password_md5, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
		header("Location: dados_pessoais.php");
	}
?>
