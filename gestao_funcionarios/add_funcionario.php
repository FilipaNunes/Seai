<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>
<?php include_once("database/database.php"); ?>


<?php
	
		function addFuncionario($nome_completo,$morada,$email,$telemovel,$nif){
		
		
		$query = "INSERT INTO funcionario(nome_completo,morada,email,telemovel,nif)
			      VALUES(:nome_completo, :morada, :email, :telemovel, :nif)";
				  
		
		$values = array($nome_completo,$morada,$email,$telemovel,$nif);
		$insert = array(':nome_completo', ':morada', ':email', ':telemovel' ,':nif');
		
		$result = execQuery($query,$insert,$values);
	}


?>