<?php
  include_once('../database/database.php');
?>

<?php
  $ano = $_POST["ano"];
  $mes = $_POST["mes"];
  $atrasos = $_POST["atrasos"];
  $faltas_jus = $_POST["faltas_jus"];
  $faltas_injus = $_POST["faltas_injus"];
  $numfunc = $_POST["numfunc"];
  $salario = $_POST["salario"];

  $data = $ano . "-" . $mes . "-01";

  $query = 'SELECT EXISTS(SELECT * FROM infor_funcionario WHERE data=:data AND id_f= :numfunc)';

  $values = array($data,$numfunc);
	$insert = array(':data',':numfunc');

	$result = execQuery($query,$insert,$values);

  $verifica = $result->fetch();

  if ($verifica["exists"] == false){
    $query ='INSERT INTO infor_funcionario(id_f,n_faltas_just,n_faltas_injust,atrasos,salario,data)
             VALUES(:numfunc,:faltas_jus,:faltas_injus,:atrasos,:salario,:data)';

    $values = array($numfunc,$faltas_jus,$faltas_injus,$atrasos,$salario,$data);
    $insert = array(':numfunc',':faltas_jus',':faltas_injus',':atrasos',':salario',':data');

    $result = execQuery($query,$insert,$values);
  } else{
    $query = 'UPDATE infor_funcionario SET id_f=:numfunc, n_faltas_just=:faltas_jus, n_faltas_injust=:faltas_injus, atrasos=:atrasos, salario=:salario, data=:data WHERE id_f=:numfunc AND data=:data';

    $values = array($numfunc,$faltas_jus,$faltas_injus,$atrasos,$salario,$data);
    $insert = array(':numfunc',':faltas_jus',':faltas_injus',':atrasos',':salario',':data');

    $result = execQuery($query,$insert,$values);
  }

  $message = array('status' => 'valid');

	echo json_encode($message);

 ?>
