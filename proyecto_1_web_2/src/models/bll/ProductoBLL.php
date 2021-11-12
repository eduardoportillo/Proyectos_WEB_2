<?php

namespace App\models\bll;

use App\models\conexion\ConexionDB;
use App\models\dto\Producto;
use PDO;
use double;

class ProductoBLL
{
    public function selectAll(): array
    {
        $listaDatos = array();
        $objConnection = new ConexionDB();
        $res = $objConnection->query("SELECT * FROM productos");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = $this->rowToDto($row);
            $listaDatos[] = $obj;
        }
        return $listaDatos;
    }

    public function select($id): ?Producto
    {
        $objConnection = new ConexionDB();
        $res = $objConnection->queryWithParams("SELECT * FROM productos WHERE producto_id = :varId",
            array(":varId" => $id));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objProducto = $this->rowToDto($row);

        return $objProducto;
    }

    public function selectMonto($id): float
    {
        $objConnection = new ConexionDB();
        $res = $objConnection->queryWithParams("SELECT precio FROM productos WHERE producto_id = :varId",
            array(":varId" => $id));

        $row = $res->fetch(PDO::FETCH_ASSOC);

        return $row['precio'];
    }

    public function insert(
        String $nombre_producto,
        String $codigo,
        String $Descripcion,
        double $precio
    ): int
    {

        $objConnection = new ConexionDB();

        $res = $objConnection->queryWithParams(
            "INSERT INTO productos (nombre_producto,codigo,Descripcion,precio)
            VALUES(:varNombreProducto, :varCodigo, :varDescripcion, :varprecio)",
            array(
                ":varCodigo" => uniqid(),
                ":varNombreProducto" => $nombre_producto,
                ":varcodigo" => $codigo,
                ":varDescripcion" => $Descripcion,
                ":varprecio" => $precio
            )
        );

        if ($res->rowCount() == 0) {
            return 0;
        }
//        $row = $res->fetch(PDO::FETCH_ASSOC);
//        return $row['ultimoId'];

        return $objConnection->getLastInsertedId();
    }

    public function update(
        String $nombre_producto,
        String $Descripcion,
        double $precio,
        int    $id
    )
    {
        $objConnection = new ConexionDB();
        $objConnection->queryWithParams(
            "
            UPDATE productos
            SET nombre_producto=:varNombreProducto,
            Descripcion=:varDescripcion,
            precio=:varPrecio
            WHERE producto_id = :varId",
            array(
                ":varNombreProducto" => $nombre_producto,
                ":varDescripcion" => $Descripcion,
                ":varPrecio" => $precio,
                ":varId" => $id
            )
        );
    }

    public function delete($id)
    {
        $objConnection = new ConexionDB();
        $objConnection->queryWithParams("DELETE FROM productos WHERE producto_id = :varId",
            array(":varId" => $id)
        );
    }


    private function rowToDto($row): Producto
    {
        $objProducto = new Producto();
        $objProducto->setProductoId($row['producto_id']);
        $objProducto->setNombreProducto($row['nombre_producto']);
        $objProducto->setCodigo($row['codigo']);
        $objProducto->setDescripcion($row['Descripcion']);
        $objProducto->setPrecio($row['precio']);

        return $objProducto;
    }
}