<?php

namespace Source\Models\Lists;

use Source\Core\Connect;

class Lists
{
    private $id;
    private $idUser;
    private $name;

    public function __construct(
        $id = null,
        $idUser = null,
        $name = null,
    )
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->name = $name;
    }

    public function insert(){
        $query = "INSERT INTO lists (idUser, name) VALUES (:idUser, :name)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return true;
    }

    public function getByIdUser(){
        $query = "SELECT * FROM lists WHERE idUser = :idUser";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }

        return $stmt->fetchAll();
    }

    public function getById(){
        $query = "SELECT * FROM lists WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }

        return $stmt->fetch();
        return;
    }

    public function deleteById(){
        $query = "DELETE FROM lists WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return true;
    }

//    public function insert(){
//        $query = "INSERT INTO lists (idUser, text) VALUES (:idUser, :text)";
//        $stmt = Connect::getInstance()->prepare($query);
//        $stmt->bindParam(":idUser", $this->idUser);
//        $stmt->bindParam(":text", $this->text);
//        $stmt->execute();
//        return true;
//    }
//
//    public function getAll(){
//        $query = "SELECT * FROM lists WHERE idUser = :idUser";
//        $stmt = Connect::getInstance()->prepare($query);
//        $stmt->bindParam(":idUser", $this->idUser);
//        $stmt->execute();
//
//        return $stmt->fetchAll();
//    }
//
//    public function deleteById(){
//        $query = "DELETE FROM lists WHERE id = :id";
//        $stmt = Connect::getInstance()->prepare($query);
//        $stmt->bindParam(":id", $this->id);
//        $stmt->execute();
//        return;
//    }

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
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $text
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}