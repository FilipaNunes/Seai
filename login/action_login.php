<?php  set_include_path( get_include_path() . PATH_SEPARATOR .                  "/usr/users2/mieec2013/up201305659/public_html/SEAI/" . PATH_SEPARATOR .                  "/usr/users2/miec2013/up201305298/public_html/Seai/"); ?>

<?php

    function verifica_login($username, $password){
        global $conn;

        include_once ("database/database.php");

        if (!isset($conn)){
            db();
        }

        return check_login_db($username, $password);
    } 

    session_start();

    if (isset($_POST["login"])){
        $id = verifica_login($_POST["username"], $_POST["password"]);
		print_r($id);
        $_SESSION["user_id"] = $id;
        
        if ($id != NULL) {
        header("Location: ../index.php");
		}

		else {
		header("Location: wronglogin.php");
		}
    }

?>
