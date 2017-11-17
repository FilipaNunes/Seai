<?php
    include_once("/usr/users2/mieec2013/up201305659/public_html/SEAI/database/database.php");

    /* Permite bloquear páginas com acesso restrito a utilizadores com login efectuado - para já não está a ser usado */
    function check_session ($path) {
        if ($_SESSION["user_id"] == NULL){
            header("Location: $path");
            die();
        }
    }
    
	/* Permite bloquear páginas com acesso restrito a administradores - para já não está a ser usado */
    function check_admin ($path) {
            db();

        if (!check_admin_db()){
            header("Location: $path");
            die();
        }
    }

    session_start();
    if (!isset($_SESSION["user_id"])){
        $_SESSION["user_id"] = NULL;
    }
?>
