<?php

namespace App\models\dto;

use App\models\bll\ClienteBLL;

class venta
{
    private $id_venta;
    private $cliente_id;
    private $productos;
    private $monto;

    /**
     * @return mixed
     */
    public function getIdVenta()
    {
        return $this->id_venta;
    }

    /**
     * @param mixed $id_venta
     */
    public function setIdVenta($id_venta): void
    {
        $this->id_venta = $id_venta;
    }

    /**
     * @return mixed
     */
    public function getClienteId()
    {
        return $this->cliente_id;
    }

    /**
     * @param mixed $cliente_id
     */
    public function setClienteId($cliente_id): void
    {
        $this->cliente_id = $cliente_id;
    }

    /**
     * @return mixed
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * @param mixed $productos
     */
    public function setProductos($productos): void
    {
        $this->productos = $productos;
    }

    /**
     * @return mixed
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * @param mixed $monto
     */
    public function setMonto($monto): void
    {
        $this->monto = $monto;
    }

    public function getClienteForDisplay()
    {
        $clienteBLL = new ClienteBLL();
        $objCliente = $clienteBLL->select($this->getClienteId());
        return $objCliente->getNombreCompleto();
    }

}