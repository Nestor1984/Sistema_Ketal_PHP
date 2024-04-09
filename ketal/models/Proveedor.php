<?php
require 'Connection.php';

class Proveedor
{
    private string $codigo;
    private string $nombre;
    private string $ciudad;
    private string $pais;

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
    public function getCiudad(): string
    {
        return $this->ciudad;
    }

    /**
     * @param string $ciudad
     */
    public function setCiudad(string $ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return string
     */
    public function getPais(): string
    {
        return $this->pais;
    }

    /**
     * @param string $pais
     */
    public function setPais(string $pais)
    {
        $this->pais = $pais;
    }

    public function guardar(): bool
    {
        $connect = new Connection();
        $link = $connect->connect();

        $prep = $link->prepare("
            INSERT INTO proveedor (codigo, nombre, ciudad, pais)
            VALUES (:codigo, :nombre, :ciudad, :pais)
        ");
        $prep->bindParam(':codigo', $this->codigo);
        $prep->bindParam(':nombre', $this->nombre);
        $prep->bindParam(':ciudad', $this->ciudad);
        $prep->bindParam(':pais', $this->pais);
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
            ciudad,
            pais
            FROM
            proveedor
        ");
        $res->execute();
        $clientes = [];
        while ($re = $res->fetchObject(Proveedor::class)) {
            $clientes[] = $re;
        }
        return $clientes;
    }
}