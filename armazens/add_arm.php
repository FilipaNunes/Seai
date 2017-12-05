<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>
<?php include_once("database/database.php"); ?>


<?php
	
		function addArmazem($nome,$morada_arm,$ocupacao,$lotacao_max){
		
		//global $conn;
		
		$query = "INSERT INTO armazem(nome,morada_arm,ocupacao,lotacao_max)
			      VALUES(:nome, :morada_arm, :ocupacao, :lotacao_max)";
				  
		
		$values = array($nome,$morada_arm,$ocupacao,$lotacao_max);
		$insert = array(':nome', ':morada_arm', ':ocupacao', ':lotacao_max');
		
		$result = execQuery($query,$insert,$values);
	}


?>