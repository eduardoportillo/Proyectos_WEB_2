<?php

namespace App\models\dto;

class Cliente
{
    private $id_cliente;
    private $codigo;
    private $nombre_completo;
    private $telefono;
    private $carnet;
    private $sexo;
    private $edad;

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    /**
     * @param mixed $id_cliente
     */
    public function setIdCliente($id_cliente): void
    {
        $this->id_cliente = $id_cliente;
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
    public function getNombreCompleto()
    {
        return $this->nombre_completo;
    }

    /**
     * @param mixed $nombre_completo
     */
    public function setNombreCompleto($nombre_completo): void
    {
        $this->nombre_completo = $nombre_completo;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getCarnet()
    {
        return $this->carnet;
    }

    /**
     * @param mixed $carnet
     */
    public function setCarnet($carnet): void
    {
        $this->carnet = $carnet;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo): void
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param mixed $edad
     */
    public function setEdad($edad): void
    {
        $this->edad = $edad;
    }

    public function getGeneroForDisplay()
    {
        switch ($this->sexo) {
            case 0:
                return "No Definido";
            case -1:
                return "Femenino";
            case 1:
                return "Masculino";
        }
        return "";
    }

}