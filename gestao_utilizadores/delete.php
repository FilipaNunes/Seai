<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php include_once("database/database.php");?>

<?php		
	 if(isset($_GET['id']))
      {
        $id=$_GET['id'];
		$query="DELETE FROM faz WHERE id_c = :id";
        $query2="DELETE FROM clientes WHERE id_c  = :id";
		
		
		$values = array($id);
		$insert = array(':id');
		
		$result = execQuery($query,$insert,$values);
		$result2 = execQuery($query2,$insert,$values);
		

        header('location:index.php');
      }

?>
