<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/" . PATH_SEPARATOR .                  "/usr/users2/mieec2012/ee12276/public_html/SITEATUAL/Seai-master/"); ?>

<?php include_once("database/database.php");?>

<?php		
	if(isset($_GET['id']))
      {
        $id=$_GET['id'];
        $query="DELETE FROM armazem WHERE id_a  = :id";
		
		echo $id;
		$values = array($id);
		$insert = array(':id');
		
		$result = execQuery($query,$insert,$values);

		

        header('location:index.php');
      }

?>
