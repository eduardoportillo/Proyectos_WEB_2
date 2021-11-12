<?php

namespace App\controllers;

use App\models\bll\ProductoBLL;
use App\models\bll\VentaBLL;


class VentaController
{
    public static function list()
    {
        $ventaBLL = new VentaBLL();
        $listaVentas = $ventaBLL->selectAll();
        include_once "src/views/ventas/ListarTablaVentas.php";
    }

    public static function ventaProducto($cliente_id)
    {
        include_once "src/views/ventas/FormularioVentas.php";
    }

    public static function insert($request)
    {
        $ventaBLL = new VentaBLL();
        $productosBLL = new ProductoBLL();

        $monto = 0.00;

        $productosVentaArray = $request['productosVentaArray'];

        foreach ($productosVentaArray as $montoFE):
            $monto = $monto + $productosBLL->selectMonto($montoFE);
        endforeach;

        $productos = implode(",", $productosVentaArray);
        $cliente_id = $request['cliente_id'];

        $ventaBLL->insert($cliente_id, $productos, $monto);

        VentaController::list();
    }
}