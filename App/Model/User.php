<?php

namespace App\Model;

use Core\Database\QueryBuilder;
use Exception;

class Accounts
{
    public function __construct()
    {
    }

    public function verifyAcct()
    {
        if (isUsernameExist($userName)) {
            $sql = "SELECT * FROM users WHERE username = ?";
        }
        if (isEmailExist($email)) {
            $sql = "SELECT * FROM users WHERE email = ?";
        }
    }

    public function registerAcct($userName, $userEmail, $password)
    {
        $db = new QueryBuilder(APP['database']);

        $id = $this->generateID();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $params = [$id, $userName, $userEmail, $password, null, null, "pending"];

        $sql = "INSERT INTO users
                        (`id`, `username`, `email`, `password`,
                        `created_at`, `logged_in`, `logged_out`, `status`)
                        VALUES (?,?,?,?,?,?,?,?)";
        if ($db->query($sql, $params)) {
            // \Http\Mail::send($to,$subject,$message,$headers);
            // success
        }

        throw new Exception("Error Processing Request");
    }

    public function verifyToken($token, $userEmail)
    {
        $db = new QueryBuilder(APP['database']);

        $sql = "SELECT * FROM user_token WHERE `email` = ? AND `token` = ?";
        if (!$db->query($sql, [$token,$userEmail])) {
            throw new Exception("Error Processing Request");
        }

        $sql = "UPDATE users SET status = ? WHERE email = ?";
        if ($db->query($sql, ["verified, $userEmail"])) {
            // success
        }

        throw new Exception("Error Processing Request");
    }


    /****************************
                LOGIN
    ****************************/

    public function login($userName, $password)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "SELECT * FROM users WHERE `username` = ?";
        $user = $db->querySelect($sql, [$userName]);

        if (!password_verify($password, $user->password)) {
            throw new Exception("Error Processing Request");
        }

        $sql = "UPDATE users SET logged_in = ? WHERE username = ?";
        $time=date("Y-m-d H:i:s");

        if ($db->query($sql, [$time, $userName])) {
            // success
        }

        throw new Exception("Error Processing Request");
    }

    /****************************
                LOGOUT
    ****************************/
    public function logout($userName)
    {
        $db = new QueryBuilder(APP['database']);

        $sql = "UPDATE users SET logged_in = ? WHERE username = ?";
        $time=date("Y-m-d H:i:s");

        if ($db->query($sql, [$time, $userName])) {
            session_unset();
            session_destroy();
            // success
        }

        throw new Exception("Error Processing Request");
    }

    public function checkEmail($userEmail)
    {
        $db = new QueryBuilder(APP['database']);

        $sql = "SELECT * FROM users WHERE email = ?";
        $row = $db->querySelect($sql, [$userEmail]);
        // \Http\Mail::send();
    }

    public function verifyPassword($userName, $password)
    {
        $db = new QueryBuilder(APP['database']);
        $sql = "SELECT password FROM users WHERE username = ?";
        $db_password = $db->querySelect($sql, $userName);

        if (password_verify($password, $db_password)) {
            // success
        }

        throw new Exception("Error Processing Request");
    }

    public function updatePassword($userName, $userPassword)
    {
        $db = new QueryBuilder(APP['database']);
        $sql ='UPDATE users SET password = ? WHERE username = ?';

        if ($db->query($sql)) {
            // success
        }

        throw new Exception("Error Processing Request");
    }

    public function delete($id)
    {
        $db = new QueryBuilder(APP['database']);
        if ($db->query('DELETE FROM users WHERE id = ?', $id)) {
            session_unset();
            session_destroy();
            // logout
        }

        throw new Exception("Error Processing Request");
    }


    public function generateID()
    {
        $db = new QueryBuilder(APP['database']);
        $id = $db->querySelect('SELECT id FROM users ORDER BY id DESC');

        if (!$id) {
            return 'Acct-10000';
        }

        $hold = explode('-', $id);
        $id = $hold[1]+1;

        return 'Acct-'.$id;
    }
}
