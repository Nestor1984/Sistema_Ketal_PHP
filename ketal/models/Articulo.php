<?php
require 'Connection.php';

class Articulo
{
    private string $codigo;
    private string $nombre;
    private float $precio;
    private string $fecha_elaboracion;
    private string $fecha_vencimiento;

    /**
     * @return string
     */
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
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
     * @param mixed $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }

    /**
     * @param float $precio
     */
    public function setPrecio(float $precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return string
     */
    public function getFechaElaboracion(): string
    {
        return $this->fecha_elaboracion;
    }

    /**
     * @param mixed $fecha_elaboracion
     */
    public function setFechaElaboracion(string $fecha_elaboracion)
    {
        $this->fecha_elaboracion = $fecha_elaboracion;
    }

    /**
     * @return string
     */
    public function getFechaVencimiento(): string
    {
        return $this->fecha_vencimiento;
    }

    /**
     * @param mixed $fecha_vencimiento
     */
    public function setFechaVencimiento(string $fecha_vencimiento)
    {
        $this->fecha_vencimiento = $fecha_vencimiento;
    }

    public function guardar(): bool
    {
        $connect = new Connection();
        $link = $connect->connect();

        $prep = $link->prepare("
            INSERT INTO articulo (codigo, nombre, precio, fecha_elaboracion, fecha_vencimiento)
            VALUES (:codigo, :nombre, :precio, :fecha_elaboracion, :fecha_vencimiento)
        ");
        $prep->bindParam(':codigo', $this->codigo, PDO::PARAM_STR);
        $prep->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $prep->bindParam(':precio', $this->precio, PDO::PARAM_STR);
        $prep->bindParam(':fecha_elaboracion', $this->fecha_elaboracion, PDO::PARAM_STR);
        $prep->bindParam(':fecha_vencimiento', $this->fecha_vencimiento, PDO::PARAM_STR);
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
            precio,
            fecha_elaboracion,
            fecha_vencimiento
            FROM
            articulo
        ");
        $res->execute();
        $articulos = [];
        while ($re = $res->fetchObject(Articulo::class)) {
            $articulos[] = $re;
        }
        return $articulos;
    }
}