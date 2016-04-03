<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 12:50
 */
class User
{

    // Funkcje repozytorium
    static public function GetAllUsers(mysqli $conn)
    {
        $allUsers = [];

        $sql = "SELECT * FROM users";

        $result = $conn->query($sql);
        if ($result != FALSE) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user = new User();
                    $user->id = $row["id"];
                    $user->setEmail($row["email"]);
                    $user->setUsername($row["username"]);
                    $allUsers[] = $user;
                }
            }
        }

        return $allUsers;
    }

    static public function Login(mysqli $conn, $email, $password)
    {
        if (empty ($email) || empty ($password)) {
            return false;
        }
        $getUserQuery = "SELECT * FROM users WHERE email='{$email}' AND deleted=0;";
        $result = $conn->query($getUserQuery);
        if ($result->num_rows == 0) {
            return false;
        }

        $row = $result->fetch_assoc();
        $hash = $row['password'];
        if (!password_verify($password, $hash)) {
            return false;
        } else {
            $_SESSION['userId'] = $row['id'];
        }
        return true;
    }

    static public function Logout()
    {
        unset($_SESSION['userId']);
    }

    // Koniec funkcji repozytorium

    private $id;
    private $email;
    private $username;
    private $password;
    private $salt;

    public function __construct()
    {
        $this->id = -1;
        $this->email = "";
        $this->username = "";
        $this->salt = "";
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    private function hashPassword($password)
    {
        $options = [
            'cost' => 11,
            'salt' => $this->salt
        ];
        $hashedPas = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hashedPas;
    }

    private function generateSalt()
    {
        $this->salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
    }

    public function saveToDb(mysqli $conn)
    {
        if ($this->id === -1) {
            $this->generateSalt();
            $hashedPassword = $this->hashPassword($this->password);
            $date = date('Y-m-d H:i:s');
            $insertUserQuery = "INSERT INTO users (email, password, username, creationDate)
                                VALUES ('{$this->getEmail()}',
                                        '{$hashedPassword}',
                                        '{$this->getUsername()}',
                                        '{$date}')
                                ";
            $result = $conn->query($insertUserQuery);
            if (!$result && $conn->errno == 1062) {
                return 'Email already in use on this site!';
            }
            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return $result;
            }
            return $result;
        }else{
            $updateUserQuery = "UPDATE users
                                SET email='{$this->getEmail()}',
                                    username='{$this->getUsername()}'
                                WHERE id={$this->getId()}
                                ";
            $result = $conn->query($updateUserQuery);
            return $result;
        }
    }

    public function updateUserPassword(mysqli $conn, $oldPassword, $newPassword, $confirmNewPassword)
    {
        $getUserQuery = "SELECT * FROM users WHERE id={$_SESSION['userId']};";
        $result = $conn->query($getUserQuery);
        if ($result->num_rows == 0) {
            return false;
        }

        $row = $result->fetch_assoc();
        $hash = $row['password'];
        if (!password_verify($oldPassword, $hash)) {
            return 'Old password incorrect';
        }
        if ($newPassword != $confirmNewPassword) {
            return "New password and it's confirmation do not match";
        }
        $this->generateSalt();
        $hashedNewPassword = $this->hashPassword($newPassword);
        $updateUserQuery = "UPDATE users
                            SET password='{$hashedNewPassword}'
                            WHERE id={$_SESSION['userId']}
                            ;";
        $result = $conn->query($updateUserQuery);
        return $result;
    }

    public function loadFromDb(mysqli $conn, $id)
    {

        $sql = "SELECT * FROM users WHERE id={$id}";
        $result = $conn->query($sql);
        if ($result != FALSE) {
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->setUsername($row['username']);
                $this->setEmail($row['email']);
                return true;
            }
        }
        return false;
    }

    public function deleteUser(mysqli $conn)
    {
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id={$this->id}";
            $result = $conn->query($sql);
            if ($result != FALSE) {
                $this->id = -1;
                $this->name = "";
                $this->surname = "";
                $this->dateOfBirth = "";
                return true;
            }
        }
        return false;
    }

    public function getAllMyPosts(mysqli $conn){
        $myPosts = Post::GetAllUserPosts($conn, $this->getId());

        return $myPosts;
    }

    public function getAllMessages()
    {
        // TODO soon
    }

    public function getAllFriends()
    {
        // TODO... someday... maybe...
    }

}