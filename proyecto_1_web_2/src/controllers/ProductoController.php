<?php

namespace App\controllers;

use App\models\bll\ProductoBLL;

class ProductoController
{
    public static function list()
    {
        $productoBLL = new ProductoBLL();
        $listaProducto = $productoBLL->selectAll();
        include_once "src/views/productos/ListarTablaProductos.php";
    }

    public function selecAllProductos() : array
    {
        $productoBLL = new ProductoBLL();
        return $productoBLL->selectAll();
    }
}