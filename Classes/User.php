<?php
include_once 'DbConnection.php';
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 12:50
 */
class User
{
    private $id;
    public $email;
    public $username;
    private $password;
    private $salt;

    public function __construct(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        if(!empty($_SESSION['user'])){
            $user=$_SESSION['user'];
            $this->id=$user['id'];
            $this->email=$user['email'];
            $this->username=$user['username'];
            $this->salt=$user['salt'];
        }
    }

    public function addUser ($email, $password, $username = null){
        if (empty ($email) ||empty ($password)){
            return false;
        }
        $this->generateSalt();
        $hashedPassword = $this->hashPassword($password);
        $conn = DbConnection::getConnection();
        $insertUserQuery = 'INSERT INTO users (email, password, username, salt)
                            VALUES ("'.$email.'","'.$hashedPassword.'","'.$username.'","'.$this->salt.'");';
        $result=$conn->query($insertUserQuery);
        if (!$result && $conn->errno == 1062){
            return 'Email already exists!';
        }
        $conn->close();
        return $result;
    }

    private function hashPassword($password){
        $options = [
            'cost' => 11,
            'salt' => $this->salt
        ];
        $hashedPas = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hashedPas;
    }

    private function generateSalt(){
        $this->salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
    }

    public function login ($email, $password)
    {
        if (empty ($email) || empty ($password)) {
            return false;
        }
        $conn = DbConnection::getConnection();
        $getUserQuery = 'SELECT * FROM users WHERE email="'.$email.'";';
        $result = $conn->query($getUserQuery);
        if ($result->num_rows == 0){
            return false;
        }
        $user = $result->fetch_assoc();
        $this->salt = $user['salt'];
        $hashedPassword = $this->hashPassword($password);
        if ($hashedPassword != $user['password']){
            return false;
        }
        unset($user['password']);
        $_SESSION['user'] = $user;
        return true;
    }

    public function logout(){
        unset($_SESSION['user']);
    }

    public function updateUser ($email, $username = null){
        $conn = DbConnection::getConnection();
        $updateUserQuery = 'UPDATE users
                            SET email="'.$email.'"
                                username="'.$username.'"
                            WHERE id= '.$this->id.'
        ;';
        $result = $conn->query($updateUserQuery);
        $conn->close();
        return $result;
    }

    public function updateUserPassword($oldPassword, $newPassword, $confirmNewPassword){
        $conn = DbConnection::getConnection();
        $getUserQuery = 'SELECT * FROM users WHERE id="'.$this->id.'";';
        $result = $conn->query($getUserQuery);
        if ($result->num_rows == 0){
            return false;
        }
        $user = $result->fetch_assoc();
        $this->salt = $user['salt'];
        $hashedOldPassword = $this->hashPassword($oldPassword);
        if ($hashedOldPassword != $user['password']){
            return 'Old password incorrect';
        }
        if ($newPassword != $confirmNewPassword){
            return "New password and it's confirmation do not match";
        }
        $hashedNewPassword = $this->hashPassword($newPassword);
        $updateUserQuery = 'UPDATE users
                            SET password="'.$hashedNewPassword.'"
                            WHERE id="'.$this->id.'"
                            ;';
        $result=$conn->query($updateUserQuery);
        $conn->close();
        return $result;
    }

    public function deleteUser(){

    }

    public function getAllPosts(){

    }

    public function getAllMessages(){

    }

    public function getAllFriends(){

    }

}