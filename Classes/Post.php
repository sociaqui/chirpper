<?php
require_once 'DbConnection.php';

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-19
 * Time: 19:24
 */
class Post
{

    private $postId;
    private $authorId;
    private $postText;
    private $isDeleted;

    public function __construct()
    {
        $this->postId = -1;
        $this->authorId = 0;
        $this->postText = '';
        $this->isDeleted = 0;
    }

    public function loadFromDb($id)
    {
        $conn = DbConnection::getConnection();
        $sqlGetPost = 'SELECT * FROM posts WHERE deleted=0 AND id=' . $id;
        $result = $conn->query($sqlGetPost);
        if ($result->num_rows != 1) {
            return false;
        } else {
            $tempPost = $result->fetch_assoc();
            $this->postId = $tempPost['id'];
            $this->setAuthorId($tempPost['user_id']);
            $this->setPostText($tempPost['content']);
            $this->setIsDeleted(0);
        }
        $conn->close();
        $conn = null;
        return true;
    }

    public function addToDb()
    {
        if (!$this->checkAuthor() || !(strlen($this->postText) > 0)) {
            return false;
        }
        $conn = DbConnection::getConnection();
        $addPostSql = 'INSERT INTO posts (user_id, content, creationDate)
                          VALUES ("' . $this->authorId . '", "' . $this->postText . '","' . date("Y-m-d H:i:s") . '")';
        $result = $conn->query($addPostSql);
        $conn->close();
        $conn = null;
        return $result;
    }

    public function updatePost()
    {
        if (!$this->checkAuthor() || !(strlen($this->postText) > 0)) {
            return false;
        }
        if (!isset($_SESSION['user']) || $_SESSION['user']['id'] != $this->authorId) {
            return false;
        }
        $conn = DbConnection::getConnection();
        $updatePostSql = 'UPDATE posts SET content="' . $this->postText . '"
                            WHERE id=' . $this->getPostId();
        $result = $conn->query($updatePostSql);
        $conn->close();
        $conn = null;
        return $result;
    }

    /* TODO
    public function showTweet() {
        if (!isset($_SESSION)) {
            return false;
        }
        $editLink = '';
        $deleteLink = '';
        if ($this->authorId == $_SESSION['user']->getId()) {
            $editLink = '<a class="btn btn-xs btn-primary" href="index.php?editTweet='.$this->getTweetId().'">Edytuj</a>';
            $deleteLink = '<a class="btn btn-xs btn-primary" href="index.php?deleteTweet='.$this->getTweetId().'">Usuń</a>';
        }
        $tweetDate = $this->getCreateDate();
        echo '<div class="panel panel-primary">';
        echo '<div class="panel-heading">Tweet z '.substr($tweetDate,0,strlen($tweetDate)-3).' '.$editLink.' '.$deleteLink.'</div>';
        echo '<div class="panel-body">'.$this->tweetText.'</div>';
        echo '</div>';
    }
    */

    /* TODO
    public function deleteTweet() {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getId() != $this->authorId) {
            return false;
        }
        $dbConnection = DbConnection::getConnection();
        $updateTweetSql = 'UPDATE tweets SET deleted=1,
                            updated="'.date('Y-m-d').'" WHERE id='.$this->getTweetId();
        $result = $dbConnection->query($updateTweetSql);
        $dbConnection->close();
        $dbConnection=null;
        return $result;
    }
    */

    private function checkAuthor()
    {
        $conn = DbConnection::getConnection();
        $getUserQuery = 'SELECT * FROM users WHERE id="' . $this->authorId . '";';
        $result = $conn->query($getUserQuery);
        if ($result->num_rows != 1) {
            return false;
        }
        $conn->close();
        $conn = null;
        return true;
    }

    public function getAllComments()
    {
        //TODO
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId($authorId)
    {
        $temp = $this->authorId;
        $this->authorId = $authorId;
        if (!$this->checkAuthor()) {
            $this->authorId = $temp;
            return false;
        }
        return true;
    }

    public function getPostText()
    {
        return $this->postText;
    }

    public function setPostText($postText)
    {
        if (strlen($postText) > 0) {
            $this->postText = $postText;
        }
    }

    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    public function setIsDeleted($isDeleted)
    {
        if (is_bool($isDeleted)) {
            $this->isDeleted = $isDeleted;
        }
    }
}