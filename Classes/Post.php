<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-19
 * Time: 19:24
 */
class Post
{

    // Funkcje repozytorium
    static public function GetAllUserPosts(mysqli $conn, $userId)
    {
        $allPosts = [];

        $sql = "SELECT * FROM posts WHERE user_id={$userId} ORDER BY modificationDate DESC";

        $result = $conn->query($sql);
        if ($result != FALSE) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $post = new Post();
                    $post->postId = $row["id"];
                    $post->setAuthorId($row["user_id"]);
                    $post->setPostText($row["content"]);
                    $post->setDate($row["modificationDate"]);
                    $allPosts[] = $post;
                }
            }
        }

        return $allPosts;
    }
    // Koniec funkcji repozytorium

    private $postId;
    private $authorId;
    private $postText;
    private $date;

    public function __construct()
    {
        $this->postId = -1;
        $this->authorId = -1;
        $this->postText = "";
        $this->date = "";
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    public function getPostText()
    {
        return $this->postText;
    }

    public function setPostText($postText)
    {
        $this->postText = $postText;
    }

    public function savePost(mysqli $conn)
    {
        if ($this->postId === -1) {
            $this->date = date('Y-m-d H:i:s');
            $insertsql = "INSERT INTO posts (user_id, content, creationDate)
                                VALUES ('{$this->getAuthorId()}',
                                        '{$this->getPostText()}',
                                        '{$this->date}')
                                ";
            $result = $conn->query($insertsql);
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

    public function loadPost(mysqli $conn, $id)
    {

        $sql = "SELECT * FROM posts WHERE id={$id}";
        $result = $conn->query($sql);
        if ($result != FALSE) {
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                $this->postId = $row["id"];
                $this->setAuthorId($row["user_id"]);
                $this->setPostText($row["content"]);
                $this->setDate($row["modificationDate"]);
                return true;
            }
        }
        return false;
    }

    public function deletePost(mysqli $conn)
    {
        if ($this->postId != -1) {
            $sql = "DELETE FROM posts WHERE id={$this->postId}";
            $result = $conn->query($sql);
            if ($result != FALSE) {
                $this->postId = -1;
                $this->authorId = -1;
                $this->postText = "";
                $this->date = "";
                return true;
            }
        }
        return false;
    }

    public function getAllComments()
    {
        // TODO as first priority
    }

}