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

	$options = ['cost' => 12];

	$user_data = user_data_db();
	$user_data1 = $user_data->fetch(PDO::FETCH_ASSOC);
	
	$pass_result = password_verify($_POST["password"] , $user_data1["password"]);
	$password_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);
	
	$query = "SELECT nif FROM clientes WHERE nif = :nif";
	$values = array($_POST["nif"]);
	$insert = array(':nif');
	$result = execQuery($query, $insert, $values);
	$result2 = $result->rowCount($result);
	print_r();
	if ($_POST["update"] AND ($pass_result != true) ) {
		header("Location: update_dados2.php");
		exit();
	}
	
	elseif ($_POST["update"] AND $_POST["new_password"]==NULL AND $_POST["confirm_new_password"]==NULL) {
		if ($_POST["nif"] == $user_data1["nif"]) {
			update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $password_hashed, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
			header("Location: dados_pessoais.php");
		}
		elseif ($result2 > 0) header("Location: update_dados3.php");
		else {
			update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $password_hashed, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
			header("Location: dados_pessoais.php");
		}
	}

	elseif ($_POST["update"] AND ($_POST["new_password"]!=NULL OR $_POST["confirm_new_password"]!=NULL) AND ($_POST["new_password"] == $_POST["confirm_new_password"])) {
		if ($_POST["nif"] == $user_data1["nif"]) {
			$new_password_hashed = password_hash($_POST["new_password"], PASSWORD_DEFAULT, $options);
			update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $new_password_hashed, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
			header("Location: dados_pessoais.php");
		}
		elseif ($result2 > 0) header("Location: update_dados3.php");
		else {
		$new_password_hashed = password_hash($_POST["new_password"], PASSWORD_DEFAULT, $options);
		update_user_db($_POST["name"], $_POST["email"], $_POST["username"], $new_password_hashed, $_POST["telephone"], $_POST["nif"], $_POST["address"]);
		header("Location: dados_pessoais.php");
		}
	}
	
	elseif ($_POST["update"] AND ($_POST["new_password"]!=NULL OR $_POST["confirm_new_password"]!=NULL) AND ($_POST["new_password"] != $_POST["confirm_new_password"])) {
		header("Location: update_dados4.php");
		exit();
	}
?>
