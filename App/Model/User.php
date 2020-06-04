<?php

namespace App\Model;

use Core\Database\QueryBuilder;
use Exception;

class Accounts
{
    private $acct_userName;
    private $acct_email;
    private $acct_password;

    public function __construct()
    {
    }

    
    public function verifyAcct()
    {
        $stmt = $this->conn->prepare('SELECT * FROM users
                                      WHERE acct_userName=?');
        $stmt->bindparam('1', $this->acct_userName);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['formMsg']="Username already exist.";
            header('location:../index.php');
            exit();
        } else {
            $stmt_2 = $this->conn->prepare('SELECT * FROM users
                                        WHERE acct_email=?');
            $stmt_2->bindparam('1', $this->acct_email);
            $stmt_2->execute();

            if ($stmt_2->rowCount() > 0) {
                $_SESSION['formMsg']="Email Address already exist.";
                header('location:../index.php');
                exit();
            }
        }
    }
    public function registerAcct()
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO users (acct_id, acct_userName, acct_email, acct_password,acct_created,acct_login_time,acct_logout_time, acct_token, acct_status)
																		      VALUES (?,?,?,?,?,"0000-00-000 00:00:00","0000-00-000 00:00:00",?,"verify")');
            //generate unique ID for security
            $acct_uid = $this->generateID();
            // hash password for security
            $acct_pwd = password_hash($this->acct_password, PASSWORD_DEFAULT);
            // token for account validation
            $acct_token = md5(uniqid(mt_rand(), true));
            $time=date("Y-m-d H:i:s");

            $stmt->bindparam('1', $acct_uid);
            $stmt->bindparam('2', $this->acct_userName);
            $stmt->bindparam('3', $this->acct_email);
            $stmt->bindparam('4', $acct_pwd);
            $stmt->bindparam('5', $time);
            $stmt->bindparam('6', $acct_token);
            $stmt->execute();

            if (!$stmt) {
                $_SESSION['formMsg']="Something went wrong, please try again.";
                header('location:../index.php');
                exit();
            } else {
                // mail the token to verify
                $subject = 'Brand-Name | Verify Account';
                $message = '
              =======================
              Username: '.$this->acct_uName.
              'Password: '.$this->acct_pwd.
              '
              =======================
              Verify Account:https://www.url/?email='.$this->acct_email.'&token='.$acct_token.
              '
              ===============================

              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              illum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              ';
                mail($this->acct_email, $subject, $message);

                $_SESSION['formMsg']="Success, please check your email to verify your account.";
                header('location:../index.php');
                exit();
            }
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }

    /****************************
              VERIFY TOKEN
    ****************************/
    public function verifyToken($userToken, $userEmail)
    {
        try {
            // verify if email and token match
            $stmt = $this->conn->prepare('SELECT * FROM users
																		WHERE acct_email = ? AND acct_token = ?');
            $stmt->bindparam('1', $userEmail);
            $stmt->bindparam('2', $userToken);
            $stmt->execute();

            if (!$stmt) {
                // return
                $_SESSION['formMsg']="Something went wrong, please try again or request another.";
                header('location:../index.php');
                exit();
            } else {
                // update status
                $stmt2 = $this->conn->prepare('UPDATE users SET acct_status = "Verified"
                                            WHERE acct_email = ? AND acct_token = ?');
                $stmt2->bindparam('1', $userEmail);
                $stmt2->bindparam('2', $userToken);
                $stmt2->execute();

                if (!$stmt2) {
                    //return
                    $_SESSION['formMsg']="Something went wrong, please try again or request another.";
                    header('location:../index.php');
                    exit();
                } else {
                    // next page
                    echo "success";
                }
            }
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }


    /****************************
                LOGIN
    ****************************/

    public function login($userName, $userPassword)
    {
        try {
            $stmt = $this->conn->prepare('SELECT * FROM users
																		WHERE acct_userName= :userNameEmail
																		OR acct_email= :userNameEmail LIMIT 1');
            $stmt->bindparam(':userNameEmail', $userName);
            $stmt->execute();
            $row=$stmt->fetch();

            if ($stmt->rowCount() < 1) {
                $_SESSION['formMsg']="Username or Email did`nt match.";
                header('location:../index.php');
                exit();
            } else {
                // verify if input password and database password match
                // password_verify() works with password_hash()
                if (!password_verify($userPassword, $row['acct_password'])) {
                    $_SESSION['formMsg']="Password did`nt match.";
                    header('location:../index.php');
                    exit();
                } else {
                    $stmt_2 = $this->conn->prepare('UPDATE users SET acct_login_time = ?
                                WHERE acct_userName = ?');
                    $time=date("Y-m-d H:i:s");
                    $stmt_2->bindparam('1', $time);
                    $stmt_2->bindparam('2', $userName);
                    $stmt_2->execute();

                    if (!$stmt_2) {
                        $_SESSION['formMsg']="Something went wrong, please try again.";
                        header('location:../index.php');
                        exit();
                    } else {
                        //next page
                        $_SESSION['userName']=$userName;
                        $_SESSION['formMsg']="Welcome.";
                        header('location:../home.php?success');
                        exit();
                    }
                }
            }
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }

    /****************************
                LOGOUT
    ****************************/
    public function logout($userName)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE users SET acct_logout_time = ?
														WHERE acct_userName= ?');
            $time=date("Y-m-d H:i:s");
            $stmt->bindparam('1', $time);
            $stmt->bindparam('2', $userName);
            $stmt->execute();

            if (!$stmt) {
                $_SESSION['formMsg']="Something went wrong, please logout and try again.";
                header('location:../index.php');
                exit();
            } else {
                session_unset();
                session_destroy();
                header('location:../index.php');
                exit();
            }
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }

    /****************************
            FORGOT PASSWORD
    ****************************/
    public function checkEmail($userEmail)
    {
        try {
            $stmt = $this->conn->prepare('SELECT * FROM users WHERE acct_email = ? LIMIT 1 ');
            $stmt->bindparam('1', $userEmail);
            $stmt->execute();
            $row=$stmt->fetch();

            if ($stmt->rowCount() < 1) {
                $_SESSION['formMsg']="Email did`nt match.";
                header('location:../index.php');
                exit();
            } else {
                // give user/password/reset or a password reset only
                $subject = 'Brand-Name | Recover Account';
                $message= '
      ===============================
      username: '.$row['acct_userName'].'
      password: '.$row['acct_password'].'
      ===============================
      Reset Password: https://www.url/?email='.$userEmail.'&token='.$row["acct_token"].'
      ===============================

      if you didnt use our reset system we advise you to change your credentials or just ignore this message
      ';
                mail($userEmail, $subject, $message);

                $_SESSION['formMsg']="Success, Please check your email to verify your account.";
                header('location:../index.php');
                exit();
            }
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }

    /****************************
            CHANGE PASSWORD
    ****************************/
    public function verifyPwd($acct_userName)
    {
            $stmt=$this->conn->prepare('SELECT * FROM users
																	WHERE acct_userName = ? LIMIT 1');
            $stmt->bindparam('1', $acct_userName);
            $stmt->execute();

            if (!$stmt) {
                $_SESSION['formMsg']="Something went wrong, please logout and try again.";
                header('location:../index.php');
                exit();
            } else {
                $row=$stmt->fetch();
                if ($stmt->rowCount() < 1) {
                    // verify if input password and database password match
                    // password_verify() works with password_hash()
                    if (!password_verify($this->acct_password, $row['acct_password'])) {
                        $_SESSION['formMsg']="Old Password did`nt match.";
                        header('location:../index.php');
                        exit();
                    }
                }
            }
    }

    public function update($userName, $userPassword)
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
