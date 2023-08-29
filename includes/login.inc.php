<?php
if (isset($_POST["submit"])) {
    // grab the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    // instantiate signup class
    require_once "../classes/dbh.classes.php";
    require_once "../classes/login.classes.php";
    require_once "../classes/login-contr.classes.php";
    // estamos a criar um objeto da classs
    $login = new LoginContr($uid,$pwd);
    // running error handlers and user signup
    $login->loginUser();
    //going to back to front page
    
    header("location: ../index.php?error=none");
}
?>