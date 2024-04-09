<?php
require 'Connection.php';

class Cliente
{
    private string $codigo;
    private string $nombre;
    private string $paterno;
    private string $materno;
    private string $direccion;
    private int $telefono;
    private string $correo;

    /**
     * @return string
     */
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     */
    public function setCodigo(string $codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getPaterno(): string
    {
        return $this->paterno;
    }

    /**
     * @param string $paterno
     */
    public function setPaterno(string $paterno)
    {
        $this->paterno = $paterno;
    }

    /**
     * @return string
     */
    public function getMaterno(): string
    {
        return $this->materno;
    }

    /**
     * @param string $materno
     */
    public function setMaterno(string $materno)
    {
        $this->materno = $materno;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion(string $direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return int
     */
    public function getTelefono(): int
    {
        return $this->telefono;
    }

    /**
     * @param int $telefono
     */
    public function setTelefono(int $telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getCorreo(): string
    {
        return $this->correo;
    }

    /**
     * @param string $correo
     */
    public function setCorreo(string $correo)
    {
        $this->correo = $correo;
    }

    public function guardar(): bool
    {
        $connect = new Connection();
        $link = $connect->connect();

        $prep = $link->prepare("
            INSERT INTO cliente (codigo, nombre, paterno, materno, direccion, telefono, correo)
            VALUES (:codigo, :nombre, :paterno, :materno, :direccion, :telefono, :correo)
        ");
        $prep->bindParam(':codigo', $this->codigo, PDO::PARAM_STR);
        $prep->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $prep->bindParam(':paterno', $this->paterno, PDO::PARAM_STR);
        $prep->bindParam(':materno', $this->materno, PDO::PARAM_STR);
        $prep->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);
        $prep->bindParam(':telefono', $this->telefono, PDO::PARAM_INT);
        $prep->bindParam(':correo', $this->correo, PDO::PARAM_STR);
        try {
            $prep->execute();
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }
    public function getList(): array
    {
        $connect = new Connection();
        $link = $connect->connect();

        $res = $link->prepare("
            SELECT
            codigo, 
            nombre, 
            paterno, 
            materno, 
            direccion, 
            telefono, 
            correo
            FROM
            cliente
        ");
        $res->execute();
        $clientes = [];
        while ($re = $res->fetchObject(Cliente::class)) {
            $clientes[] = $re;
        }
        return $clientes;
    }
}