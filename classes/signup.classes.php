<?php
class Signup extends Dbh
{
    protected function checkUser($uid, $email)
    {
        // ?  quer dizer igual a algo
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users where users_uid = ? OR users_email = ?;');
        // $stmt->execute() substitui o ?
        // proteje de sql injecten porque separa a query dos dados
        if (!$stmt->execute(array($uid, $email))) {
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        $resultCheck = false;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
    protected function setUser($ui, $pwd, $email)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid,users_pwd,users_email) VALUES(?,?,?);');
        // encripta a passwords
        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
        
        if (!$stmt->execute(array($ui, $hashedPwd, $email))) {
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

}
?>