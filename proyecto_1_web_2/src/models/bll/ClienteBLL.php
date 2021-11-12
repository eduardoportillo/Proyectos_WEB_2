<?php

namespace App\models\bll;

use App\models\conexion\ConexionDB;
use App\models\dto\Cliente;
use PDO;

class ClienteBLL
{
    public function selectAll(): array
    {
        $listaDatos = array();
        $objConnection = new ConexionDB();
        $res = $objConnection->query("SELECT * FROM clientes");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = $this->rowToDto($row);
            $listaDatos[] = $obj;
        }
        return $listaDatos;
    }

    public function select($id): ?Cliente
    {
        $objConnection = new ConexionDB();
        $res = $objConnection->queryWithParams("SELECT * FROM clientes WHERE id_cliente = :varId",
            array(":varId" => $id));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objCliente = $this->rowToDto($row);

        return $objCliente;
    }

    public function insert(
        string $nombre_completo,
        int $telefono,
        int $carnet,
        int $sexo,
        int $edad
    ): int
    {

        $objConnection = new ConexionDB();

        $res = $objConnection->queryWithParams(
            "INSERT INTO clientes (codigo,nombre_completo,telefono,carnet,sexo,edad)
            VALUES(:varCodigo, :varNombreCompleto, :varTelefono, :varCarnet, :varSexo, :varEdad)",
            array(
                ":varCodigo" => uniqid(),
                ":varNombreCompleto" => $nombre_completo,
                ":varTelefono" => $telefono,
                ":varCarnet" => $carnet,
                ":varSexo" => $sexo,
                ":varEdad" => $edad
            )
        );

        if ($res->rowCount() == 0) {
            return 0;
        }
//        $row = $res->fetch(PDO::FETCH_ASSOC);
//        return $row['ultimoId'];

        return $objConnection->getLastInsertedId();
    }

    public function update($nombresCompleto, $telefono, $carnet, $sexo, $edad, $id)
    {
        $objConnection = new ConexionDB();
        $objConnection->queryWithParams(
            "
            UPDATE clientes
            SET nombre_completo=:varNombres,
            telefono=:varTelefono,
            carnet=:varCarnet,
            sexo=:varSexo,
            edad=:varEdad
            WHERE id_cliente = :varId",
            array(
                ":varNombres" => $nombresCompleto,
                ":varTelefono" => $telefono,
                ":varCarnet" => $carnet,
                ":varSexo" => $sexo,
                ":varEdad" => $edad,
                ":varId" => $id
            )
        );
    }

    public function delete($id)
    {
        $objConnection = new ConexionDB();
        $objConnection->queryWithParams("DELETE FROM clientes WHERE id_cliente = :varId",
            array(":varId" => $id)
        );
    }

    private function rowToDto($row): Cliente
    {
        $objCliente = new Cliente();
        $objCliente->setIdCliente($row['id_cliente']);
        $objCliente->setCodigo($row['codigo']);
        $objCliente->setNombreCompleto($row['nombre_completo']);
        $objCliente->setTelefono($row['telefono']);
        $objCliente->setCarnet($row['carnet']);
        $objCliente->setSexo($row['sexo']);
        $objCliente->setEdad($row['edad']);

        return $objCliente;
    }
}