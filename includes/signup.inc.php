<?php
if (isset($_POST["submit"])) {
    // grab the data
    $uid = $_POST["uid"];
    
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
    // instantiate signup class
    require_once "../classes/dbh.classes.php";
    require_once "../classes/signup.classes.php";
    require_once "../classes/signup-contr.classes.php";
    // estamos a criar um objeto da classs
    $signup = new SignupContr($uid,$pwd,$pwdRepeat,$email);
    // running error handlers and user signup
    $signup->signupUser();
    //going to back to front page
    
    header("location: ../index.php?error=none");
}
?>