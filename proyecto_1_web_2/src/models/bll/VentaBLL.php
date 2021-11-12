<?php

namespace App\models\bll;
use App\models\conexion\ConexionDB;
use App\models\dto\venta;
use PDO;
use double;

class VentaBLL
{
    public function selectAll(): array
    {
        $listaDatos = array();
        $objConnection = new ConexionDB();
        $res = $objConnection->query("SELECT * FROM ventas");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = $this->rowToDto($row);
            $listaDatos[] = $obj;
        }
        return $listaDatos;
    }

    public function insert(
        int    $cliente_id,
        String $productos,
        float $monto
    ): int
    {

        $objConnection = new ConexionDB();

        $res = $objConnection->queryWithParams(
            "INSERT INTO ventas (cliente_id,productos,monto)
            VALUES(:varClienteId,:varProductos,:varMonto)",
            array(
                ":varClienteId" => $cliente_id,
                ":varProductos" => $productos,
                ":varMonto" => $monto
            )
        );

        if ($res->rowCount() == 0) {
            return 0;
        }
//        $row = $res->fetch(PDO::FETCH_ASSOC);
//        return $row['ultimoId'];

        return $objConnection->getLastInsertedId();
    }

    private function rowToDto($row): venta
    {
        $objVenta = new venta();
        $objVenta->setIdVenta($row['id_venta']);
        $objVenta->setClienteId($row['cliente_id']);
        $objVenta->setProductos($row['productos']);
        $objVenta->setMonto($row['monto']);

        return $objVenta;
    }
}