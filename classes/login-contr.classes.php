<?php
class LoginContr extends Login
//extends Signup
{
    private $uid;
    private $pwd;



    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
 
    }
    public function loginUser(){
        if($this->emptyInput() == false){
            // echo Empty Input !
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        $this->getUser($this->uid, $this->pwd);
    }
    private function emptyInput()
    {
        $result = false;
        if (empty($this->uid) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
?>