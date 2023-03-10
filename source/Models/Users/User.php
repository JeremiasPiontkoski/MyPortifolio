<?php

namespace Source\Models\Users;

use Source\Core\Connect;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $typeUser;
    private $photo;

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct(
        $id = null,
        $name = null,
        $email = null,
        $password = null,
        $typeUser = null,
        $photo = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->typeUser = $typeUser;
        $this->photo = $photo;
    }

    public function insert(){
        $query = "INSERT INTO users (name, email, password, typeUser, photo) VALUES (:name, :email, :password, :typeUser, :photo)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password, PASSWORD_DEFAULT));
        $stmt->bindParam(":typeUser", $this->typeUser);
        $stmt->bindParam(":photo", $this->photo);
        $stmt->execute();

        return Connect::getInstance()->lastInsertId();
    }

    public function validade(String $email, String $password){
        $query = "SELECT * FROM users WHERE `email` = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        }
        $user = $stmt->fetch();

        if(!password_verify($password, $user->password)){
            return false;
        }

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->typeUser = $user->typeUser;
        $this->photo = $user->photo;

        $this->setSession($this->id);
        return true;
    }

    private function setSession($id){
        $_SESSION['user'] = $id;
        return true;
    }

    public static function isRegisteredEmail(String $email){
        $query = "SELECT * FROM users WHERE `email` = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        }
        return true;
    }

    public function updateById(){
        $query = "UPDATE `users` SET name = :name, email = :email, photo = :photo WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":photo", $this->photo);
        $stmt->execute();
        return true;
    }

    public function getAllById(){
        $query = "SELECT * FROM `users` WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        }

        return $stmt->fetch();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * @param mixed $typeUser
     */
    public function setTypeUser($typeUser): void
    {
        $this->typeUser = $typeUser;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }
}