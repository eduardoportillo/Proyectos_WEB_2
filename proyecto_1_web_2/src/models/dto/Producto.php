<?php

namespace App\models\dto;

class Producto
{
    private $producto_id;
    private $nombre_producto;
    private $codigo;
    private $Descripcion;
    private $precio;

    /**
     * @return mixed
     */
    public function getProductoId()
    {
        return $this->producto_id;
    }

    /**
     * @param mixed $producto_id
     */
    public function setProductoId($producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    /**
     * @return mixed
     */
    public function getNombreProducto()
    {
        return $this->nombre_producto;
    }

    /**
     * @param mixed $nombre_producto
     */
    public function setNombreProducto($nombre_producto): void
    {
        $this->nombre_producto = $nombre_producto;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     */
    public function setDescripcion($Descripcion): void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }



}