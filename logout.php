<?php
    include_once("login/session.php");
    session_destroy();

    header ("Location: index.php");
?>
