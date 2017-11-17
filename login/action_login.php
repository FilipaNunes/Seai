<?php

    function verifica_login ($username, $password){
        $password_md5 = md5($password);
        global $conn;

        include_once ("/usr/users2/mieec2013/up201305659/public_html/SEAI/database/database.php");

        if (!isset($conn)){
            db();
        }

        return check_login_db($username, $password);
    } 

    session_start();

    if (isset($_POST["login"])){
        $id = verifica_login($_POST["username"], $_POST["password"]);
        $_SESSION["user_id"] = $id;
        header("Location: ../index.php"); // Depois do login confirmado, encaminha para a página inicial
    }

?>
