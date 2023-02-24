<?php

namespace Source\Models\Lists;

use Source\Core\Connect;

class ItemList
{
    private $id;
    private $idList;
    private $name;
    private $email;
    private $phone;

    /**
     * @param $id
     * @param $idList
     * @param $name
     * @param $email
     * @param $phone
     */
    public function __construct(
        $id = null,
        $idList = null,
        $name = null,
        $email = null,
        $phone = null
    )
    {
        $this->id = $id;
        $this->idList = $idList;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function insert(){
        $query = "INSERT INTO `items-list` (idList, name, email, phone) VALUES (:idList, :name, :email, :phone)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idList", $this->idList);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->execute();
        return true;
    }

    public function getByIdList(){
        $query = "SELECT * FROM `items-list` WHERE idList = :idList";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idList", $this->idList);
        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return false;
        }
        return $stmt->fetchAll();
    }

    public function getById(){
        $query = "SELECT * FROM `items-list` WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        }

        return $stmt->fetch();
    }

    public function deleteById(){
        $query = "DELETE FROM `items-list` WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return true;
    }

    public function updateById(){
        $query = "UPDATE `items-list` SET name = :name, email = :email, phone = :phone WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->execute();
        return true;
    }

    public static function isRegisteredName(String $name){
        $query = "SELECT * FROM `items-list` WHERE `name` = :name";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        }
        return true;
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
    public function getIdList()
    {
        return $this->idList;
    }

    /**
     * @param mixed $idList
     */
    public function setIdList($idList): void
    {
        $this->idList = $idList;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }
}