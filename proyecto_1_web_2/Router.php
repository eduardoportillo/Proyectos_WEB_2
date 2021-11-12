<?php

use App\controllers\ClienteController;
use App\controllers\ProductoController;
use App\controllers\VentaController;

$controller = "cliente";
if (isset($_REQUEST['controller'])) {
    $controller = $_REQUEST['controller'];
}
$action = "list";
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
}

switch ($controller) {
    case "cliente":
        switch ($action) {
            case "list":
                ClienteController::list();
                break;
            case "create":
                ClienteController::create();
                break;
            case "insert":
                ClienteController::insert($_POST);
                break;
            case "edit":
                ClienteController::edit($_GET["id_cliente"]);
                break;
            case "update":
                ClienteController::update($_POST);
                break;
            case "delete":
                ClienteController::delete($_GET["id_cliente"]);
                break;
        }
        break;
    case "producto":
        switch ($action) {
            case "list":
                ProductoController::list();
                break;
//            case "insert":
//                ProductoController::insert($_POST);
//                break;
//            case "create":
//                ProductoController::create();
//                break;
//            case "edit":
//                ProductoController::edit($_GET["id"]);
//                break;
//            case "update":
//                ProductoController::update($_POST);
//                break;
//            case "delete":
//                ProductoController::delete($_GET["id"]);
//                break;
        }
        break;

    case "venta":
        switch ($action) {
            case "list":
                VentaController::list();
                break;

            case "ventaproducto":
                VentaController::ventaProducto($_GET["cliente_id"]);
                break;

            case "insert":
                VentaController::insert($_POST);
                break;

//            case "create":
//                ProductoController::create();
//                break;
//            case "edit":
//                ProductoController::edit($_GET["id"]);
//                break;
//            case "update":
//                ProductoController::update($_POST);
//                break;
//            case "delete":
//                ProductoController::delete($_GET["id"]);
//                break;
        }
        break;
}
