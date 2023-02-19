<?php

namespace Source\Models\Users;

use Source\Core\Connect;

/*MAKE THIS ABSTRACT ??*/
class TypeUser
{
    private $id;
    private $type;

    public function __construct(
        $id = null,
        $type = null
    )
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function getAll(){
        $query = "SELECT * FROM `type-users`";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        }
        return $stmt->fetchAll();
    }

    public function getUserPerson(){
        $query = "SELECT * FROM `type-users` WHERE `type` = 'normal-user'";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        }
        return $stmt->fetch();
    }

    public function getAdmin(){
        $query = "SELECT * FROM `type-users` WHERE `type` = 'admin'";
        $stmt = Connect::getInstance()->prepare($query);
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }
}