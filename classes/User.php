<?php

include_once(__DIR__ . '/Db.php');

class User {
    private $username;
    private $email;
    private $password;

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

     public function save() {
        $conn = Db::getConnection();
        // Controleer of username of email al bestaat
        $statement = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $statement->bindValue(":username", $this->username);
        $statement->bindValue(":email", $this->email);
        $statement->bindValue(":password", password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 12]));
        $statement->execute();
    }

    public static function getAll() {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}