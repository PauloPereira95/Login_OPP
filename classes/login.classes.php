<?php
class Login extends Dbh
{
    protected function getUser($uid, $pwd)
    {
        // ?  quer dizer igual a algo
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users where users_uid = ? OR users_email = ?;');
        // $stmt->execute() substitui o ?
        // proteje de sql injecten porque separa a query dos dados
        if (!$stmt->execute(array($uid, $uid))) {
            $stmt = null;
            header("location:../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfund&{1}");
            exit();
        }
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // users_pwd é o nome da tabela
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);

        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } else if ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users where users_uid = ? OR users_email = ? AND users_pwd=?;');
            if (!$stmt->execute(array($uid, $uid,$pwdHashed[0]['user_pwd']))) {
                $stmt = null;
                header("location:../index.php?error=stmtfailed");
                exit();
            }
            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location:../index.php?error=usernotfund&{2}");
                exit();
            }
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];
            $stmt = null;
        }

    }
}
?>