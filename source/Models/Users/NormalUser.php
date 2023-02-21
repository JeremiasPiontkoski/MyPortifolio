<?php

namespace Source\Models\Users;

use Source\Core\Connect;

class NormalUser extends User
{
    private $id;
    private $idUser;

    /**
     * @param $idUser
     */
    public function __construct(
        $idUser = null
    )
    {
        $this->idUser = $idUser;
    }

    public function insert()
    {
        $query = "INSERT INTO `normal-users` (idUser) VALUES (:idUser)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idUser", $this->idUser);
        $stmt->execute();
        return true;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $idUser
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}